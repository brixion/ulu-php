<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\PaginatedList;
use Brixion\Ulu\Dto\VehicleCompanyGroup;

final class VehicleCompanyGroupsResource extends AbstractResource
{
    /**
     * @param array<string, mixed> $vehicleCompanyGroup
     */
    public function create(int $companyGroupId, array $vehicleCompanyGroup): VehicleCompanyGroup
    {
        $response = $this->http->request('POST', 'company_groups/' . $companyGroupId . '/vehicle_company_groups', [
            'company_group_id' => $companyGroupId,
            'vehicle_company_group' => $vehicleCompanyGroup,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['vehicle_company_group'] ?? null) ? $response['vehicle_company_group'] : [];

        return VehicleCompanyGroup::fromArray($data);
    }

    /**
     * @return PaginatedList<VehicleCompanyGroup>
     */
    public function list(int $companyGroupId, ?int $page = null, ?int $limit = null): PaginatedList
    {
        $response = $this->http->request('GET', 'company_groups/' . $companyGroupId . '/vehicle_company_groups', query: [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['vehicle_company_groups'] ?? null) ? $response['vehicle_company_groups'] : [];

        return new PaginatedList(VehicleCompanyGroup::listFromResponse($items));
    }

    public function get(int $companyGroupId, int $vehicleCompanyGroupId): VehicleCompanyGroup
    {
        $response = $this->http->request('GET', 'company_groups/' . $companyGroupId . '/vehicle_company_groups/' . $vehicleCompanyGroupId);

        /** @var array<string, mixed> $data */
        $data = is_array($response['vehicle_company_group'] ?? null) ? $response['vehicle_company_group'] : [];

        return VehicleCompanyGroup::fromArray($data);
    }

    public function delete(int $companyGroupId, int $vehicleCompanyGroupId): void
    {
        $this->http->request('DELETE', 'company_groups/' . $companyGroupId . '/vehicle_company_groups/' . $vehicleCompanyGroupId);
    }
}
