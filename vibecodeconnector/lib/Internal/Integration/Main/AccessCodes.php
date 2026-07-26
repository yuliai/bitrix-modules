<?php

declare(strict_types=1);

namespace Bitrix\Vibecodeconnector\Internal\Integration\Main;

use CAccess;

/**
 * Wrapper over the main access API (`\CAccess`).
 * Returns the user's access codes (U<id>, G<id>, D<id>, AU, ...).
 */
final class AccessCodes
{
	/**
	 * @return string[]
	 */
	public function getUserCodes(int $userId): array
	{
		if ($userId <= 0)
		{
			return [];
		}

		$codes = array_keys((new CAccess())->GetUserCodesArray($userId));
		$codes[] = 'U' . $userId;

		return array_values(array_unique(array_filter(
			$codes,
			static fn (mixed $code): bool => is_string($code) && $code !== '',
		)));
	}
}
