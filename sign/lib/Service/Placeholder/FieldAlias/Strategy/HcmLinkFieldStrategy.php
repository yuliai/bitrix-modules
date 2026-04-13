<?php

namespace Bitrix\Sign\Service\Placeholder\FieldAlias\Strategy;

use Bitrix\Sign\Service\Placeholder\FieldAlias\AliasContext;
use Bitrix\Sign\Service\Placeholder\FieldAlias\AliasRoleResolver;
use Bitrix\Sign\Service\Integration\HumanResources\HcmLinkFieldService;
use Bitrix\Sign\Service\Container;
use Bitrix\HumanResources\Type\HcmLink\FieldType as HcmFieldType;
use Bitrix\Sign\Type\BlockCode;
use Bitrix\Sign\Type\BlockParty;

class HcmLinkFieldStrategy extends AbstractAliasStrategy
{
	private const ALIAS_PREFIX = '1C';

	private HcmLinkFieldService $hcmLinkFieldService;

	public function __construct(
		?HcmLinkFieldService $hcmLinkFieldService = null,
		?AliasRoleResolver $aliasRoleResolver = null,
	)
	{
		parent::__construct($aliasRoleResolver);
		$this->hcmLinkFieldService = $hcmLinkFieldService ?? Container::instance()->getHcmLinkFieldService();
	}

	public function getAliasPrefixes(): array
	{
		return [self::ALIAS_PREFIX];
	}

	public function supportsFieldName(string $fieldName): bool
	{
		return str_starts_with($fieldName, HcmLinkFieldService::FIELD_PREFIX);
	}

	public function supportsAlias(string $alias): bool
	{
		return str_starts_with($alias, self::ALIAS_PREFIX . '.');
	}

	public function fieldNameToAlias(string $fieldName, AliasContext $context): ?string
	{
		$parsed = $this->hcmLinkFieldService->parseName($fieldName);

		if ($parsed === null)
		{
			return null;
		}

		$roleName = $this->getRoleName($context, $parsed->party);
		$shortTypeName = $this->getShortNameByType($parsed->type);

		return self::ALIAS_PREFIX . ".{$roleName}.{$shortTypeName}";
	}

	public function aliasToFieldName(string $alias, AliasContext $context): ?string
	{
		$aliasData = $this->parseAliasFieldPartWithParty($alias, $context, self::ALIAS_PREFIX);
		if ($aliasData === null)
		{
			return null;
		}

		$shortTypeName = $aliasData['fieldPart'];
		$party = $aliasData['party'];
		
		$fieldTypeId = $this->getTypeByShortName($shortTypeName);
		
		if ($fieldTypeId === null)
		{
			return null;
		}
		
		if ($context->hcmLinkCompanyId === null)
		{
			return null;
		}
		
		return $this->findFieldByType(
			$context->hcmLinkCompanyId,
			$fieldTypeId,
			$party,
		);
	}
	
	private function getShortNameByType(int $typeId): string
	{
		$typeMap = $this->getFieldTypeShortNames();
		return $typeMap[$typeId] ?? "Type{$typeId}";
	}
	
	private function getTypeByShortName(string $shortName): ?int
	{
		$reverseMap = $this->getShortNameToFieldType();
		return $reverseMap[$shortName] ?? null;
	}
	
	private function getFieldTypeShortNames(): array
	{
		return [
			HcmFieldType::FIRST_NAME->value => 'Name',
			HcmFieldType::LAST_NAME->value => 'LastName',
			HcmFieldType::PATRONYMIC_NAME->value => 'Patronymic',
			HcmFieldType::POSITION->value => 'Pos',
			HcmFieldType::SNILS->value => 'Snils',
			HcmFieldType::PHONE->value => 'Phone',
			HcmFieldType::EMAIL->value => 'Email',
			HcmFieldType::BIRTHDAY->value => 'Dob',
			HcmFieldType::INN->value => 'Inn',
			HcmFieldType::ADDRESS->value => 'Addr',
			HcmFieldType::DEPARTMENT->value => 'Dept',
			HcmFieldType::DOCUMENT_REGISTRATION_NUMBER->value => 'DocNum',
			HcmFieldType::DOCUMENT_UID->value => 'DocUid',
			HcmFieldType::DOCUMENT_DATE->value => 'DocDate',
			HcmFieldType::STRING->value => 'Text',
		];
	}
	
	/**
	 * Get reverse mapping: shortName => fieldTypeId
	 * This is the flipped version of getFieldTypeShortNames()
	 */
	private function getShortNameToFieldType(): array
	{
		return array_flip($this->getFieldTypeShortNames());
	}
	
	private function findFieldByType(int $companyId, int $fieldTypeId, int $party): ?string
	{
		if (!$this->hcmLinkFieldService->isAvailable())
		{
			return null;
		}

		$fields = $this->hcmLinkFieldService->getFieldsForSelector($companyId, true);

		$category = $party === BlockParty::NOT_LAST_PARTY ? 'REPRESENTATIVE' : 'EMPLOYEE';

		if (!isset($fields[$category]['FIELDS']))
		{
			return null;
		}

		foreach ($fields[$category]['FIELDS'] as $field)
		{
			if ($field['type'] === $fieldTypeId && $this->getPartyFromFieldName($field['name']) === $party)
			{
				return $this->createFieldName(
					blockCode: BlockCode::B2E_HCMLINK_REFERENCE,
					fieldType: $this->getFieldTypeByTypeId($fieldTypeId),
					party: $party,
					fieldCode: $field['name'],
				);
			}
		}

		return null;
	}
	
	private function getFieldTypeByTypeId(int $fieldTypeId): string
	{
		$typeMap = [
			HcmFieldType::FIRST_NAME->value => 'firstname',
			HcmFieldType::LAST_NAME->value => 'lastname',
			HcmFieldType::PATRONYMIC_NAME->value => 'patronymic',
			HcmFieldType::POSITION->value => 'position',
			HcmFieldType::SNILS->value => 'snils',
			HcmFieldType::PHONE->value => 'phone',
			HcmFieldType::EMAIL->value => 'email',
			HcmFieldType::BIRTHDAY->value => 'date',
			HcmFieldType::INN->value => 'string',
			HcmFieldType::ADDRESS->value => 'address',
			HcmFieldType::DEPARTMENT->value => 'string',
			HcmFieldType::DOCUMENT_REGISTRATION_NUMBER->value => 'string',
			HcmFieldType::DOCUMENT_UID->value => 'string',
			HcmFieldType::DOCUMENT_DATE->value => 'date',
			HcmFieldType::STRING->value => 'string',
		];

		return $typeMap[$fieldTypeId] ?? 'string';
	}
	
	private function getPartyFromFieldName(string $fieldName): ?int
	{
		return $this->hcmLinkFieldService->parseName($fieldName)?->party;
	}
}
