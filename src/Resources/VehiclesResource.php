<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\PaginatedList;
use Brixion\Ulu\Dto\Vehicle;

final class VehiclesResource extends AbstractResource
{
    /**
     * @return PaginatedList<Vehicle>
     */
    public function list(?int $page = null, ?int $limit = null): PaginatedList
    {
        $response = $this->http->request('GET', 'vehicles', query: [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['vehicles'] ?? null) ? $response['vehicles'] : [];

        return new PaginatedList(Vehicle::listFromResponse($items));
    }

    public function get(int $vehicleId): Vehicle
    {
        $response = $this->http->request('GET', 'vehicles/'.$vehicleId);

        /** @var array<string, mixed> $data */
        $data = is_array($response['vehicle'] ?? null) ? $response['vehicle'] : [];

        return Vehicle::fromArray($data);
    }

    /**
     * @param array<string, mixed> $vehicle
     * @return list<Vehicle>
     */
    public function create(array $vehicle): array
    {
        $response = $this->http->request('POST', 'vehicles/', [
            'vehicle' => $vehicle,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['vehicles'] ?? null) ? $response['vehicles'] : [];

        return Vehicle::listFromResponse($items);
    }

    /**
     * @param array<string, mixed> $vehicle
     * @return list<Vehicle>
     */
    public function update(int $vehicleId, array $vehicle): array
    {
        $response = $this->http->request('PUT', 'vehicles/'.$vehicleId, [
            'vehicle' => $vehicle,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['vehicles'] ?? null) ? $response['vehicles'] : [];

        return Vehicle::listFromResponse($items);
    }

    public function disconnect(int $vehicleId): Vehicle
    {
        $response = $this->http->request('POST', 'vehicles/'.$vehicleId.'/disconnect');

        /** @var array<string, mixed> $data */
        $data = is_array($response['vehicle'] ?? null) ? $response['vehicle'] : [];

        return Vehicle::fromArray($data);
    }

    /**
     * @return list<Vehicle>
     */
    public function delete(int $vehicleId): array
    {
        $response = $this->http->request('DELETE', 'vehicles/'.$vehicleId);

        /** @var list<mixed> $items */
        $items = is_array($response['vehicles'] ?? null) ? $response['vehicles'] : [];

        return Vehicle::listFromResponse($items);
    }
}
