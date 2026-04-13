<?php

namespace Bitrix\Sign\Service\Placeholder\FieldAlias\Strategy;

use Bitrix\Sign\Service\Placeholder\FieldAlias\AliasContext;
use Bitrix\Sign\Service\Placeholder\FieldAlias\AliasRoleResolver;
use Bitrix\Sign\Service\Placeholder\FieldAlias\FieldNameTransformer;
use Bitrix\Sign\Type\BlockCode;
use Bitrix\Sign\Type\FieldType;

class CompanyFieldStrategy extends AbstractAliasStrategy
{
	private const ALIAS_PREFIX = 'Com';
	private const BLOCK_CODE = BlockCode::B2E_MY_REFERENCE;
	private const UF_PREFIX = 'COMPANY_UF_CRM_COMPANY_';
	
	private FieldNameTransformer $transformer;

	public function __construct(
		?FieldNameTransformer $transformer = null,
		?AliasRoleResolver $aliasRoleResolver = null,
	)
	{
		parent::__construct($aliasRoleResolver);
		$this->transformer = $transformer ?? new FieldNameTransformer();
	}

	public function getAliasPrefixes(): array
	{
		return [self::ALIAS_PREFIX];
	}

	public function supportsFieldName(string $fieldName): bool
	{
		$parsed = $this->parseFieldName($fieldName);
		
		if (!$this->hasRequiredParsedValues($parsed, ['blockCode', 'fieldCode']))
		{
			return false;
		}

		if ($parsed['blockCode'] !== self::BLOCK_CODE)
		{
			return false;
		}
		
		$fieldCode = $parsed['fieldCode'];
		
		if ($this->transformer->isCompanyField($fieldCode))
		{
			return true;
		}
		
		return str_starts_with($fieldCode, self::UF_PREFIX);
	}

	public function supportsAlias(string $alias): bool
	{
		return str_starts_with($alias, self::ALIAS_PREFIX . '.');
	}

	public function fieldNameToAlias(string $fieldName, AliasContext $context): ?string
	{
		$parsed = $this->parseFieldName($fieldName);
		
		if (!$this->hasRequiredParsedValues($parsed, ['fieldCode'], ['party']))
		{
			return null;
		}

		$fieldCode = $parsed['fieldCode'];
		$party = $parsed['party'];
		
		if (str_starts_with($fieldCode, self::UF_PREFIX))
		{
			return $this->buildDynamicAliasFromParsedField($parsed, $context, self::ALIAS_PREFIX);
		}
		
		$shortFieldName = $this->transformer->toShortName($fieldCode);
		
		if ($shortFieldName !== $fieldCode)
		{
			$roleName = $this->getRoleName($context, $party);

			return self::ALIAS_PREFIX . ".{$roleName}.{$shortFieldName}";
		}
		
		return null;
	}

	public function aliasToFieldName(string $alias, AliasContext $context): ?string
	{
		$aliasData = $this->parseAliasFieldPartWithParty($alias, $context, self::ALIAS_PREFIX);
		if ($aliasData === null)
		{
			return null;
		}

		$shortFieldName = $aliasData['fieldPart'];
		$party = $aliasData['party'];
		
		if (preg_match('/^(\w+?)(\d{' . self::DYNAMIC_FIELD_TIMESTAMP_LENGTH . '})$/', $shortFieldName, $matches))
		{
			$typeShortcut = $matches[1];
			$timestamp = $matches[2];
			
			$fieldType = array_search($typeShortcut, self::TYPE_SHORTCUTS, true);
			
			if ($fieldType === false)
			{
				$fieldType = strtolower($typeShortcut);
			}
			
			$fieldCode = self::UF_PREFIX . $timestamp;
			
			return $this->createFieldName(
				blockCode: self::BLOCK_CODE,
				fieldType: $fieldType,
				party: $party,
				fieldCode: $fieldCode,
			);
		}
		
		$fieldCode = $this->transformer->toFullFieldCode($shortFieldName);
		
		if ($fieldCode !== null)
		{
			$fieldType = $this->getFieldType($fieldCode);
			
			return $this->createFieldName(
				blockCode: self::BLOCK_CODE,
				fieldType: $fieldType,
				party: $party,
				fieldCode: $fieldCode,
			);
		}
		
		return null;
	}

	/**
	 * Get field type for the given company field code
	 * @param string $fieldCode Company field code (e.g., COMPANY_TITLE, COMPANY_RQ_ADDR_LEGAL, etc.)
	 * @return FieldType::ADDRESS|FieldType::LIST|FieldType::DATE|FieldType::STRING
	 */
	private function getFieldType(string $fieldCode): string
	{
		if (str_starts_with($fieldCode, 'COMPANY_RQ_ADDR_'))
		{
			return FieldType::ADDRESS;
		}
		
		if (in_array($fieldCode, ['COMPANY_COMPANY_TYPE', 'COMPANY_INDUSTRY', 'COMPANY_EMPLOYEES'], true))
		{
			return FieldType::LIST;
		}
		
		if (in_array($fieldCode, ['COMPANY_LAST_ACTIVITY_TIME', 'COMPANY_RQ_COMPANY_REG_DATE'], true))
		{
			return FieldType::DATE;
		}
		
		return FieldType::STRING;
	}
}
