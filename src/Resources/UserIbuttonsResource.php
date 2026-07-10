<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\PaginatedList;
use Brixion\Ulu\Dto\UserIbutton;

final class UserIbuttonsResource extends AbstractResource
{
    /**
     * @param array<string, mixed> $userIbutton
     */
    public function create(int $ibuttonId, array $userIbutton): UserIbutton
    {
        $response = $this->http->request('POST', 'settings/ibuttons/' . $ibuttonId . '/user_ibuttons', [
            'user_ibutton' => $userIbutton,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['user_ibutton'] ?? null) ? $response['user_ibutton'] : [];

        return UserIbutton::fromArray($data);
    }

    /**
     * @param array<string, mixed> $userIbutton
     */
    public function update(int $ibuttonId, int $userIbuttonId, array $userIbutton): UserIbutton
    {
        $response = $this->http->request('PUT', 'settings/ibuttons/' . $ibuttonId . '/user_ibuttons/' . $userIbuttonId, [
            'user_ibutton' => $userIbutton,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['user_ibutton'] ?? null) ? $response['user_ibutton'] : [];

        return UserIbutton::fromArray($data);
    }

    /**
     * @return PaginatedList<UserIbutton>
     */
    public function list(int $ibuttonId, ?int $page = null, ?int $limit = null): PaginatedList
    {
        $response = $this->http->request('GET', 'settings/ibuttons/' . $ibuttonId . '/user_ibuttons', query: [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['user_ibuttons'] ?? null) ? $response['user_ibuttons'] : [];

        return new PaginatedList(UserIbutton::listFromResponse($items));
    }

    public function get(int $ibuttonId, int $userIbuttonId): UserIbutton
    {
        $response = $this->http->request('GET', 'settings/ibuttons/' . $ibuttonId . '/user_ibuttons/' . $userIbuttonId);

        /** @var array<string, mixed> $data */
        $data = is_array($response['user_ibutton'] ?? null) ? $response['user_ibutton'] : [];

        return UserIbutton::fromArray($data);
    }

    public function delete(int $ibuttonId, int $userIbuttonId): void
    {
        $this->http->request('DELETE', 'settings/ibuttons/' . $ibuttonId . '/user_ibuttons/' . $userIbuttonId);
    }
}
