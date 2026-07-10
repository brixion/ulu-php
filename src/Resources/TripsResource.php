<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\PaginatedList;
use Brixion\Ulu\Dto\Trip;
use Brixion\Ulu\Dto\TripPoint;
use Brixion\Ulu\Dto\TripType;

final class TripsResource extends AbstractResource
{
    /**
     * @return list<Trip>
     */
    public function listForVehicle(int $vehicleId, string $fromStartAt, string $toStartAt): array
    {
        $response = $this->http->request('GET', 'vehicles/' . $vehicleId . '/trips', [
            'from_start_at' => $fromStartAt,
            'to_start_at' => $toStartAt,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['trips'] ?? null) ? $response['trips'] : [];

        return Trip::listFromResponse($items);
    }

    public function get(int $tripId): Trip
    {
        $response = $this->http->request('GET', 'trips/' . $tripId);

        /** @var array<string, mixed> $data */
        $data = is_array($response['trip'] ?? null) ? $response['trip'] : [];

        return Trip::fromArray($data);
    }

    /**
     * Create a trip from tracker app data. Restricted to tracker applications.
     *
     * @param array<string, string> $formParams
     */
    public function createFromTracker(array $formParams): void
    {
        $this->http->requestForm('POST', 'https://api.ulu.io/ulu_endpoint', $formParams);
    }

    /**
     * @return list<TripType>
     */
    public function tripTypes(): array
    {
        $response = $this->http->request('GET', 'trip_types');

        /** @var list<mixed> $items */
        $items = is_array($response['trip_type'] ?? null) ? $response['trip_type'] : [];

        return TripType::listFromResponse($items);
    }

    /**
     * @return PaginatedList<TripPoint>
     */
    public function tripPoints(int $tripId, int $page = 1, ?int $limit = null): PaginatedList
    {
        $response = $this->http->request('GET', 'trips/' . $tripId . '/trip_points', query: [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['trip_points'] ?? null) ? $response['trip_points'] : [];

        return new PaginatedList(
            TripPoint::listFromResponse($items),
            totalPages: isset($response['total_pages']) ? (int) $response['total_pages'] : null,
            currentPage: isset($response['current_page']) ? (int) $response['current_page'] : null,
            hasMore: isset($response['has_more']) ? (bool) $response['has_more'] : null,
        );
    }
}
