<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\CompanyGroup;
use Brixion\Ulu\Dto\PaginatedList;

final class CompanyGroupsResource extends AbstractResource
{
    /**
     * @param array<string, mixed> $companyGroup
     */
    public function create(array $companyGroup): CompanyGroup
    {
        $response = $this->http->request('POST', 'company_groups', [
            'company_group' => $companyGroup,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['company_group'] ?? null) ? $response['company_group'] : [];

        return CompanyGroup::fromArray($data);
    }

    /**
     * @param array<string, mixed> $companyGroup
     */
    public function update(int $companyGroupId, array $companyGroup): CompanyGroup
    {
        $response = $this->http->request('PUT', 'company_groups/' . $companyGroupId, [
            'company_group' => $companyGroup,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['company_group'] ?? null) ? $response['company_group'] : [];

        return CompanyGroup::fromArray($data);
    }

    /**
     * @return PaginatedList<CompanyGroup>
     */
    public function list(?int $page = null, ?int $limit = null): PaginatedList
    {
        $response = $this->http->request('GET', 'company_groups', query: [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['company_groups'] ?? null) ? $response['company_groups'] : [];

        return new PaginatedList(CompanyGroup::listFromResponse($items));
    }

    public function get(int $companyGroupId): CompanyGroup
    {
        $response = $this->http->request('GET', 'company_groups/' . $companyGroupId);

        /** @var array<string, mixed> $data */
        $data = is_array($response['company_group'] ?? null) ? $response['company_group'] : [];

        return CompanyGroup::fromArray($data);
    }

    public function delete(int $companyGroupId): void
    {
        $this->http->request('DELETE', 'company_groups/' . $companyGroupId);
    }
}
