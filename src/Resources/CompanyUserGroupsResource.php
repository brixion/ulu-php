<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\CompanyUserGroup;
use Brixion\Ulu\Dto\PaginatedList;

final class CompanyUserGroupsResource extends AbstractResource
{
    /**
     * @param array<string, mixed> $companyUserGroup
     */
    public function create(int $companyGroupId, array $companyUserGroup): CompanyUserGroup
    {
        $response = $this->http->request('POST', 'company_groups/'.$companyGroupId.'/company_user_groups', [
            'company_group_id' => $companyGroupId,
            'company_user_group' => $companyUserGroup,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['company_user_group'] ?? null) ? $response['company_user_group'] : [];

        return CompanyUserGroup::fromArray($data);
    }

    /**
     * @param array<string, mixed> $companyUserGroup
     */
    public function update(int $companyGroupId, int $companyUserGroupId, array $companyUserGroup): CompanyUserGroup
    {
        $response = $this->http->request('PUT', 'company_groups/'.$companyGroupId.'/company_user_groups/'.$companyUserGroupId, [
            'company_group_id' => $companyGroupId,
            'id' => $companyUserGroupId,
            'company_user_group' => $companyUserGroup,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['company_user_group'] ?? null) ? $response['company_user_group'] : [];

        return CompanyUserGroup::fromArray($data);
    }

    /**
     * @return PaginatedList<CompanyUserGroup>
     */
    public function list(int $companyGroupId, ?int $page = null, ?int $limit = null): PaginatedList
    {
        $response = $this->http->request('GET', 'company_groups/'.$companyGroupId.'/company_user_groups', [
            'company_group_id' => $companyGroupId,
        ], [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['company_user_groups'] ?? null) ? $response['company_user_groups'] : [];

        return new PaginatedList(CompanyUserGroup::listFromResponse($items));
    }

    public function get(int $companyGroupId, int $companyUserGroupId): CompanyUserGroup
    {
        $response = $this->http->request('GET', 'company_groups/'.$companyGroupId.'/company_user_groups/'.$companyUserGroupId, [
            'company_group_id' => $companyGroupId,
            'id' => $companyUserGroupId,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['company_user_group'] ?? null) ? $response['company_user_group'] : [];

        return CompanyUserGroup::fromArray($data);
    }

    public function delete(int $companyGroupId, int $companyUserGroupId): void
    {
        $this->http->request('DELETE', 'company_groups/'.$companyGroupId.'/company_user_groups/'.$companyUserGroupId, [
            'company_group_id' => $companyGroupId,
            'id' => $companyUserGroupId,
        ]);
    }
}
