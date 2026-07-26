<?php

declare(strict_types=1);

namespace Bitrix\Vibecodeconnector\Internal\Entity\Catalog;

enum CatalogListState: string
{
	case Active = 'active';
	case Hidden = 'hidden';
	case All = 'all';

	public static function fromRequest(?string $value): self
	{
		return self::tryFrom($value ?? '') ?? self::Active;
	}

	public function hiddenPredicate(): ?bool
	{
		return match ($this)
		{
			self::Active => false,
			self::Hidden => true,
			self::All => null,
		};
	}
}
