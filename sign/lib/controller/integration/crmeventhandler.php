<?php
namespace Bitrix\Sign\Controller\Integration;

use Bitrix\Crm\Activity\Provider\SignDocument;
use Bitrix\Crm\Item;
use Bitrix\Crm\ItemIdentifier;
use Bitrix\Crm\Timeline\SignDocument\DocumentData;
use Bitrix\Crm\Timeline\SignDocument\MessageData;
use Bitrix\Crm\Timeline\SignDocument\Signer;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Request;
use Bitrix\Sign\Controller\Controller;
use Bitrix\Sign\Document;
use Bitrix\Sign\Integration\CRM\Model\EventData;
use Bitrix\Crm\Automation\Trigger;

Loc::loadMessages(__FILE__);

class CrmEventHandler extends Controller
{
	private \Bitrix\Crm\Timeline\SignDocument\Controller $crmController;

	/**
	 * @param Request|null $request
	 * @throws \Bitrix\Main\LoaderException
	 */
	public function __construct(Request $request = null)
	{
		parent::__construct($request);
		if (\Bitrix\Main\Loader::includeModule('crm'))
		{
			$this->crmController = \Bitrix\Crm\Timeline\SignDocument\Controller::getInstance();
		}
	}

	public function getDefaultPreFilters(): array
	{
		return [];
	}

	/**
	 * Handle calling from proxy and create timeline event.
	 *
	 * @param array $data
	 * @param string $secCode
	 */
	public function handleTimelineEventAction(array $data, string $secCode)
	{
		$documentHash = $data['documentHash'] ?? null;
		$memberHash = $data['memberHash'] ?? null;
		$eventType = $data['eventType'] ?? null;

		$document = Document::getByHash($documentHash);
		if ($document)
		{
			if ($document->getSecCode() === $secCode)
			{
				$member = null;
				if ($memberHash)
				{
					$member = $document->getMemberByHash($memberHash);
				}
				$eventData = new EventData();
				$eventData->setEventType($eventType)
					->setDocument($document)
					->setMember($member);

				foreach ($data as $key => $value)
				{
					if ($key !== 'documentHash' && $key !== 'memberHash' && $key !== 'eventType')
					{
						$eventData->addDataValue($key, $value);
					}
				}

				$this->createTimelineEventAction(
					$eventData
				);
			}
		}
	}

	/**
	 * Create row of the Document changing in time line of the (deal/document/any related object)
	 *
	 * @param EventData $eventData
	 * @return void
	 */
	public function createTimelineEventAction(EventData $eventData): void
	{
		$eventType = $eventData->getEventType();

		$item = \Bitrix\Crm\Service\Container::getInstance()
			->getFactory(\CCrmOwnerType::SmartDocument)
			->getItem($eventData->getDocument()->getEntityId());

		if (!$item)
		{
			return;
		}

		$documentData = $this->prepareDocumentData($item, $eventData);
		$messageData = $this->prepareMessageData($eventData);

		switch ($eventType)
		{
			case EventData::TYPE_ON_CREATE:
				$this->crmController->onCreate(ItemIdentifier::createByItem($item), $documentData);
				break;
			case EventData::TYPE_ON_SEND:
				$this->crmController->onSend(ItemIdentifier::createByItem($item), $documentData, $messageData);
				break;
			case EventData::TYPE_ON_REGISTER:
				$this->crmController->onRegister(ItemIdentifier::createByItem($item), $documentData);
				break;
			case EventData::TYPE_ON_FILL:
				$this->crmController->onFill(ItemIdentifier::createByItem($item), $documentData, $messageData);
				break;
			case EventData::TYPE_ON_COMPLETE:
				$this->crmController->onComplete(ItemIdentifier::createByItem($item), $documentData);
				break;
			case EventData::TYPE_ON_REQUEST_RESULT:
				$this->crmController->onRequested(ItemIdentifier::createByItem($item), $documentData, $messageData);
				break;
			case EventData::TYPE_ON_VIEW:
				$this->crmController->onView(ItemIdentifier::createByItem($item), $documentData, $messageData);
				break;
			case EventData::TYPE_ON_SIGN:
				$this->crmController->onSigned(ItemIdentifier::createByItem($item), $documentData, $messageData);
				if ($eventData->getMember()->isInitiator())
				{
					Trigger\Sign\InitiatorSignedTrigger::executeBySmartDocumentId($item->getId());
				}
				else
				{
					Trigger\Sign\OtherMemberSignedTrigger::executeBySmartDocumentId($item->getId());
				}
				break;
			case EventData::TYPE_ON_SIGN_COMPLETED:
				$this->crmController->onSignCompleted(ItemIdentifier::createByItem($item), $documentData);
				Trigger\Sign\AllMembersSignedTrigger::executeBySmartDocumentId($item->getId());
				break;
			case EventData::TYPE_ON_INTEGRITY_SUCCESS:
				$this->crmController->onIntegritySuccess(ItemIdentifier::createByItem($item), $documentData, $messageData);
				break;
			case EventData::TYPE_ON_PREPARE_TO_FILL:
				$this->crmController->onPrepareToFill(ItemIdentifier::createByItem($item), $documentData, $messageData);
				break;
			case EventData::TYPE_ON_SEND_REPEATEDLY:
				$this->crmController->onSendRepeatedly(ItemIdentifier::createByItem($item), $documentData, $messageData);
				break;
			case EventData::TYPE_ON_SEND_FINAL:
				$this->crmController->onSendFinal(ItemIdentifier::createByItem($item), $documentData, $messageData);
				break;
			case EventData::TYPE_ON_SEND_INTEGRITY_FAILURE_NOTICE:
				$this->crmController->onSendIntegrityFailureNotice(ItemIdentifier::createByItem($item), $documentData, $messageData);
				break;
		}

		SignDocument::onDocumentUpdate(
			$item->getId(),
		);
	}

	private function getDealRelation(int $smartDocumentId): ?Item
	{
		$itemId = new \Bitrix\Crm\ItemIdentifier(
			\CCrmOwnerType::SmartDocument,
			$smartDocumentId
		);

		$itemId = (new \Bitrix\Crm\Relation\RelationManager)->getParentElements($itemId)[0] ?? null;
		if (
			!$itemId
			|| !$itemId->getEntityId()
			|| $itemId->getEntityTypeId() !== \CCrmOwnerType::Deal
		)
		{
			return null;
		}

		return \Bitrix\Crm\Service\Container::getInstance()
			->getFactory(\CCrmOwnerType::Deal)
			->getItem($itemId->getEntityId());
	}

	private function prepareDocumentData(Item $item, EventData $eventData): DocumentData
	{
		$document = $eventData->getDocument();
		$member = $eventData->getMember();

		$deal = $this->getDealRelation($item->getId());

		$bindings = [];

		if ($deal)
		{
			$bindings[] = [
				'ENTITY_TYPE_ID' => \CCrmOwnerType::Deal,
				'ENTITY_ID'=> $deal->getId(),
			];
		}

		$documentData =  \Bitrix\Crm\Timeline\SignDocument\DocumentData::createFromArray([
			'documentId' => $document->getId(),
			'documentHash' => $document->getHash(),
			'memberHash' => $member ? $member->getHash() : null ,
			'createdTime' => new \Bitrix\Main\Type\DateTime(),
			'item' => $item,
			'bindings' => $bindings,
		]);


		if ($member && $member->getContactName())
		{
			$documentData->addSigner(Signer::createFromArray([
					'title' => $member->getContactName() ?? $member->getCommunicationValue(),
					'hash' => $member->getHash(),
				]
			));
		}

		return $documentData;
	}

	/**
	 * @param EventData $eventData
	 * @return MessageData|null
	 */
	private function prepareMessageData(EventData $eventData): ?MessageData
	{
		$member = $eventData->getMember();
		if (!$member)
		{
			return null;
		}
		$type = mb_strtolower($member->getCommunicationType());
		$type = $type === 'phone'
			? 'sms'
			: $type;

		$title = $member->isInitiator()
			? ($member->getDocument()->getMeta()['initiatorName'] ?? '')
			: ($member->getContactName() ?? $member->getCommunicationValue());

		return \Bitrix\Crm\Timeline\SignDocument\MessageData::createFromArray([
			'recipient' => [
				'title' => $title ?: Loc::getMessage('SIGN_CONTROLLER_INTEGRATION_TITLE_EMPTY'),
				'hash' => $member->getHash(),
			],
			'channel' => [
				'type' => $type,
				'identifier' => $member->getCommunicationValue(),
			],
			'subject' => $eventData->getData()['subject'] ?? '',
			'author' => $eventData->getData()['author'] ?? '',
			'integrityState' => $eventData->getData()['integrityState'] ?? '',
		]);
	}
}
