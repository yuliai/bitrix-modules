<?php

declare(strict_types=1);

namespace Bitrix\Imbot\V2\Controller;

use Bitrix\Im\Bot;
use Bitrix\Main\Engine\Action;
use Bitrix\Main\Error;

class Command extends BotController
{
	/**
	 * @restMethod imbot.v2.Command.register
	 */
	public function registerAction(
		string $command,
		?array $title = null,
		?array $params = null,
		string $common = 'N',
		string $hidden = 'N',
		string $extranetSupport = 'N',
	): ?array
	{
		if (!empty($this->getErrors()))
		{
			return null;
		}

		$botId = $this->getBotId();
		$clientId = $this->getClientId();

		if (str_starts_with($command, '/'))
		{
			$command = mb_substr($command, 1);
		}

		if ($command === '')
		{
			$this->addError(new Error('Command is required', 'COMMAND_REQUIRED'));

			return null;
		}

		$existingCommands = \Bitrix\Im\Command::getListCache();
		foreach ($existingCommands as $cmdId => $existingCmd)
		{
			if (
				(int)$existingCmd['BOT_ID'] === $botId
				&& $existingCmd['COMMAND'] === $command
				&& $existingCmd['APP_ID'] === $clientId
			)
			{
				return [
					'command' => $this->formatCommand($cmdId),
				];
			}
		}

		$langSet = [];
		if ($title !== null)
		{
			foreach ($title as $langId => $titleText)
			{
				$langEntry = [
					'LANGUAGE_ID' => $langId,
					'TITLE' => $titleText,
				];
				if ($params !== null && isset($params[$langId]))
				{
					$langEntry['PARAMS'] = $params[$langId];
				}
				$langSet[] = $langEntry;
			}
		}

		$registerFields = [
			'MODULE_ID' => 'rest',
			'BOT_ID' => $botId,
			'COMMAND' => $command,
			'COMMON' => self::normalizeBooleanVariable($common) ? 'Y' : 'N',
			'HIDDEN' => self::normalizeBooleanVariable($hidden) ? 'Y' : 'N',
			'EXTRANET_SUPPORT' => self::normalizeBooleanVariable($extranetSupport) ? 'Y' : 'N',
			'APP_ID' => $clientId,
			'LANG' => $langSet,
		];

		$commandId = \Bitrix\Im\Command::register($registerFields);

		if ($commandId === false)
		{
			$this->addError(new Error('Command registration failed', 'COMMAND_REGISTER_FAILED'));

			return null;
		}

		return [
			'command' => $this->formatCommand($commandId),
		];
	}

	/**
	 * @restMethod imbot.v2.Command.unregister
	 */
	public function unregisterAction(int $commandId): ?array
	{
		if (!empty($this->getErrors()))
		{
			return null;
		}

		if (!$this->validateCommandOwnership($commandId))
		{
			return null;
		}

		$clientId = $this->getClientId();

		$result = \Bitrix\Im\Command::unRegister([
			'COMMAND_ID' => $commandId,
			'MODULE_ID' => 'rest',
			'APP_ID' => $clientId,
		]);

		if (!$result)
		{
			$this->addError(new Error('Command not found or access denied', 'COMMAND_NOT_FOUND'));

			return null;
		}

		return ['result' => true];
	}

	/**
	 * @restMethod imbot.v2.Command.update
	 */
	public function updateAction(
		int $commandId,
		array $fields = [],
	): ?array
	{
		if (!empty($this->getErrors()))
		{
			return null;
		}

		if (!$this->validateCommandOwnership($commandId))
		{
			return null;
		}

		$clientId = $this->getClientId();

		$updateFields = [];

		if (isset($fields['command']))
		{
			$cmd = $fields['command'];
			if (str_starts_with($cmd, '/'))
			{
				$cmd = mb_substr($cmd, 1);
			}
			$updateFields['COMMAND'] = $cmd;
		}

		if (isset($fields['common']))
		{
			$updateFields['COMMON'] = self::normalizeBooleanVariable($fields['common']) ? 'Y' : 'N';
		}

		if (isset($fields['hidden']))
		{
			$updateFields['HIDDEN'] = self::normalizeBooleanVariable($fields['hidden']) ? 'Y' : 'N';
		}

		if (isset($fields['extranetSupport']))
		{
			$updateFields['EXTRANET_SUPPORT'] = self::normalizeBooleanVariable($fields['extranetSupport']) ? 'Y' : 'N';
		}

		if (isset($fields['title']))
		{
			$langSet = [];
			foreach ($fields['title'] as $langId => $titleText)
			{
				$langEntry = [
					'LANGUAGE_ID' => $langId,
					'TITLE' => $titleText,
				];
				if (isset($fields['params'][$langId]))
				{
					$langEntry['PARAMS'] = $fields['params'][$langId];
				}
				$langSet[] = $langEntry;
			}
			$updateFields['LANG'] = $langSet;
		}

		$result = \Bitrix\Im\Command::update(
			[
				'COMMAND_ID' => $commandId,
				'MODULE_ID' => 'rest',
				'APP_ID' => $clientId,
			],
			$updateFields,
		);

		if (!$result)
		{
			$this->addError(new Error('Command not found or access denied', 'COMMAND_NOT_FOUND'));

			return null;
		}

		return [
			'command' => $this->formatCommand($commandId),
		];
	}

	/**
	 * @restMethod imbot.v2.Command.answer
	 */
	public function answerAction(
		int $commandId,
		int $messageId,
		string $dialogId,
		array $fields = [],
	): ?array
	{
		if (!empty($this->getErrors()))
		{
			return null;
		}

		if (!$this->validateCommandOwnership($commandId))
		{
			return null;
		}

		$botId = $this->getBotId();
		$clientId = $this->getClientId();

		$messageFields = [
			'DIALOG_ID' => $dialogId,
		];

		if (isset($fields['message']))
		{
			$messageFields['MESSAGE'] = $fields['message'];
		}

		if (isset($fields['attach']))
		{
			$messageFields['ATTACH'] = $fields['attach'];
		}

		if (isset($fields['keyboard']))
		{
			$messageFields['KEYBOARD'] = $fields['keyboard'];
		}

		if (isset($fields['menu']))
		{
			$messageFields['MENU'] = $fields['menu'];
		}

		if (isset($fields['system']))
		{
			$messageFields['SYSTEM'] = self::normalizeBooleanVariable($fields['system']) ? 'Y' : 'N';
		}

		if (isset($fields['urlPreview']))
		{
			$messageFields['URL_PREVIEW'] = self::normalizeBooleanVariable($fields['urlPreview']) ? 'Y' : 'N';
		}

		$result = \Bitrix\Im\Command::addMessage(
			[
				'MESSAGE_ID' => $messageId,
				'COMMAND_ID' => $commandId,
				'MODULE_ID' => 'rest',
				'APP_ID' => $clientId,
			],
			$messageFields,
		);

		if ($result === false)
		{
			$this->addError(new Error('Failed to send command answer', 'COMMAND_ANSWER_FAILED'));

			return null;
		}

		return ['result' => true];
	}

	/**
	 * @restMethod imbot.v2.Command.list
	 */
	public function listAction(): ?array
	{
		if (!empty($this->getErrors()))
		{
			return null;
		}

		$botId = $this->getBotId();

		$commandEntity = new \Bitrix\Im\V2\Entity\Command\Command($botId);
		$commands = $commandEntity->toRestFormat();

		return [
			'commands' => $commands,
		];
	}

	private function validateCommandOwnership(int $commandId): bool
	{
		$botId = $this->getBotId();
		$commands = \Bitrix\Im\Command::getListCache();

		if (!isset($commands[$commandId]))
		{
			$this->addError(new Error('Command not found', 'COMMAND_NOT_FOUND'));

			return false;
		}

		if ((int)$commands[$commandId]['BOT_ID'] !== $botId)
		{
			$this->addError(new Error('Command belongs to a different bot', 'COMMAND_NOT_FOUND'));

			return false;
		}

		return true;
	}

	private function formatCommand(int $commandId): ?array
	{
		$commands = \Bitrix\Im\Command::getListCache();

		if (!isset($commands[$commandId]))
		{
			return null;
		}

		$cmd = $commands[$commandId];

		return [
			'id' => (int)$cmd['ID'],
			'botId' => (int)$cmd['BOT_ID'],
			'command' => '/' . $cmd['COMMAND'],
			'common' => $cmd['COMMON'] === 'Y',
			'hidden' => $cmd['HIDDEN'] === 'Y',
			'extranetSupport' => $cmd['EXTRANET_SUPPORT'] === 'Y',
		];
	}
}
