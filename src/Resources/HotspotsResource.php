<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\Hotspot;
use Brixion\Ulu\Dto\PaginatedList;

final class HotspotsResource extends AbstractResource
{
    /**
     * @return PaginatedList<Hotspot>
     */
    public function list(?int $page = null, ?int $limit = null): PaginatedList
    {
        $response = $this->http->request('GET', 'hotspots', query: [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['hotspots'] ?? null) ? $response['hotspots'] : [];

        $hasMore = $response['has_more'] ?? null;

        return new PaginatedList(
            Hotspot::listFromResponse($items),
            hasMore: $hasMore === null ? null : filter_var($hasMore, FILTER_VALIDATE_BOOLEAN),
        );
    }
}
