<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\Ibutton;
use Brixion\Ulu\Dto\PaginatedList;

final class IbuttonsResource extends AbstractResource
{
    /**
     * @param array<string, mixed> $ibutton
     */
    public function create(array $ibutton): Ibutton
    {
        $response = $this->http->request('POST', 'settings/ibuttons', [
            'ibutton' => $ibutton,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['ibutton'] ?? null) ? $response['ibutton'] : [];

        return Ibutton::fromArray($data);
    }

    /**
     * @param array<string, mixed> $ibutton
     */
    public function update(int $ibuttonId, array $ibutton): Ibutton
    {
        $response = $this->http->request('PUT', 'settings/ibuttons/'.$ibuttonId, [
            'ibutton' => $ibutton,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['ibutton'] ?? null) ? $response['ibutton'] : [];

        return Ibutton::fromArray($data);
    }

    /**
     * @return PaginatedList<Ibutton>
     */
    public function list(?int $page = null, ?int $limit = null): PaginatedList
    {
        $response = $this->http->request('GET', 'settings/ibuttons', query: [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['ibuttons'] ?? null) ? $response['ibuttons'] : [];

        return new PaginatedList(Ibutton::listFromResponse($items));
    }

    public function get(int $ibuttonId): Ibutton
    {
        $response = $this->http->request('GET', 'settings/ibuttons/'.$ibuttonId);

        /** @var array<string, mixed> $data */
        $data = is_array($response['ibutton'] ?? null) ? $response['ibutton'] : [];

        return Ibutton::fromArray($data);
    }

    public function delete(int $ibuttonId): void
    {
        $this->http->request('DELETE', 'settings/ibuttons/'.$ibuttonId);
    }
}
