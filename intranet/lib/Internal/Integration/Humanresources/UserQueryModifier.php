<?php

declare(strict_types=1);

namespace Bitrix\Intranet\Internal\Integration\Humanresources;

use Bitrix\HumanResources\Enum\DepthLevel;
use Bitrix\HumanResources\Internals\Service\Container as HumanResourcesContainer;
use Bitrix\HumanResources\Public\Service\Container as HumanResourcesPublicContainer;
use Bitrix\HumanResources\Type\MemberEntityType;
use Bitrix\HumanResources\Type\NodeEntityType;
use Bitrix\Main\Loader;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main\ORM\Query\Query;
use Bitrix\Main\UserTable;

final class UserQueryModifier
{
	private bool $isAvailable;
	private array $userIdSubQueryCache = [];

	public function __construct()
	{
		$this->isAvailable = Loader::includeModule('humanresources');
	}

	public function injectStructureSort(Query $query, int $userId): Query
	{
		if (
			!$this->isAvailable
			|| $userId <= 0
		)
		{
			return $query;
		}

		$this->injectUserNodeSortJoin($query);

		return HumanResourcesContainer::getNodeMemberRepository()->injectUserNodeSort($query, $userId);
	}

	public function createEmployeeUserIdQuery(?array $nodeIds = null): ?Query
	{
		if (!$this->isAvailable)
		{
			return null;
		}

		$query = UserTable::query()
			->setSelect(['ID'])
			->setGroup(['ID'])
		;

		return HumanResourcesContainer::getNodeMemberRepository()->injectUserNodeSubquery(
			$query,
			active: null,
			nodeIds: !empty($nodeIds) ? $nodeIds : null,
		);
	}

	public function createEmployeeUserIdSubQuery(?array $nodeIds = null): ?string
	{
		$cacheKey = $this->getSubQueryCacheKey($nodeIds);

		if (array_key_exists($cacheKey, $this->userIdSubQueryCache))
		{
			return $this->userIdSubQueryCache[$cacheKey];
		}

		$query = $this->createEmployeeUserIdQuery($nodeIds);

		if ($query === null)
		{
			return null;
		}

		$this->userIdSubQueryCache[$cacheKey] = $query->getQuery();

		return $this->userIdSubQueryCache[$cacheKey];
	}

	public function createDepartmentUserIdSubQuery(
		string|int $departmentFilterValue,
		bool $withSubDepartments = true,
	): ?string
	{
		$preparedDepartmentFilter = $this->prepareDepartmentFilterValue(
			$departmentFilterValue,
			$withSubDepartments,
		);
		if ($preparedDepartmentFilter === null)
		{
			return null;
		}

		[$departmentId, $withSubDepartments] = $preparedDepartmentFilter;
		$cacheKey = 'department:' . $departmentId . ':' . ($withSubDepartments ? 'Y' : 'N');
		if (array_key_exists($cacheKey, $this->userIdSubQueryCache))
		{
			return $this->userIdSubQueryCache[$cacheKey];
		}

		$nodeIds = $this->resolveDepartmentNodeIds($departmentId, $withSubDepartments);
		if (empty($nodeIds))
		{
			return null;
		}

		$this->userIdSubQueryCache[$cacheKey] = $this->createEmployeeUserIdSubQuery($nodeIds);

		return $this->userIdSubQueryCache[$cacheKey];
	}

	private function resolveDepartmentNodeIds(int $departmentId, bool $withSubDepartments): array
	{
		if (!$this->isAvailable)
		{
			return [];
		}

		$departmentIdMap = [
			$departmentId => $departmentId,
		];

		if ($withSubDepartments)
		{
			foreach (
				HumanResourcesPublicContainer::getNodeService()->findChildrenByNodeIds(
					nodeIds: [$departmentId],
					nodeTypes: [NodeEntityType::DEPARTMENT],
					depthLevel: DepthLevel::FULL,
				)->getIds()
				as $subDepartmentId
			)
			{
				$departmentIdMap[$subDepartmentId] = $subDepartmentId;
			}
		}

		return array_values($departmentIdMap);
	}

	private function prepareDepartmentFilterValue(
		string|int $departmentFilterValue,
		bool $withSubDepartments = true,
	): ?array
	{
		$departmentFilterValue = trim((string)$departmentFilterValue);

		if (preg_match('/^(\d+):F$/', $departmentFilterValue, $matches))
		{
			return [(int)$matches[1], false];
		}

		if (preg_match('/^(\d+)$/', $departmentFilterValue, $matches))
		{
			return [(int)$matches[1], $withSubDepartments];
		}

		return null;
	}

	private function injectUserNodeSortJoin(Query $query): void
	{
		$departmentNodeIdQuery = \Bitrix\HumanResources\Model\NodeTable::query()
			->setSelect(['ID'])
			->where('TYPE', NodeEntityType::DEPARTMENT->value)
		;

		$query->registerRuntimeField(
			new Reference(
				'USER_NODE_MEMBER',
				\Bitrix\HumanResources\Model\NodeMember::class,
				Join::on('this.ID', 'ref.ENTITY_ID')
					->where('ref.ENTITY_TYPE', MemberEntityType::USER->value)
					->where('ref.ACTIVE', 'Y')
					->whereIn('ref.NODE_ID', $departmentNodeIdQuery),
				['join_type' => Join::TYPE_LEFT],
			),
		);
	}

	private function getSubQueryCacheKey(?array $nodeIds): string
	{
		if (empty($nodeIds))
		{
			return 'employees:all';
		}

		$nodeIds = array_values(array_unique(array_map('intval', $nodeIds)));
		sort($nodeIds);

		return 'employees:' . implode(',', $nodeIds);
	}
}
