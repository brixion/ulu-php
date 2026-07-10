<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\CompanyUser;
use Brixion\Ulu\Dto\PaginatedList;

final class CompanyUsersResource extends AbstractResource
{
    /**
     * @return PaginatedList<CompanyUser>
     */
    public function list(?int $page = null, ?int $limit = null): PaginatedList
    {
        $response = $this->http->request('GET', 'company_users', query: [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var list<mixed> $items */
        $items = is_array($response['company_users'] ?? null) ? $response['company_users'] : [];

        return new PaginatedList(CompanyUser::listFromResponse($items));
    }

    public function get(int $companyUserId, ?int $page = null, ?int $limit = null): CompanyUser
    {
        $response = $this->http->request('GET', 'company_users/' . $companyUserId, query: [
            'page' => $page,
            'limit' => $limit,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['company_user'] ?? null) ? $response['company_user'] : [];

        return CompanyUser::fromArray($data);
    }

    /**
     * @param array<string, mixed>|null $user
     * @param array<string, mixed>|null $company
     */
    public function create(?array $user = null, ?array $company = null): CompanyUser
    {
        $payload = [];

        if ($user !== null) {
            $payload['user'] = $user;
        }

        if ($company !== null) {
            $payload['company'] = $company;
        }

        $response = $this->http->request('POST', 'company_users', $payload);

        /** @var array<string, mixed> $data */
        $data = is_array($response['company_user'] ?? null) ? $response['company_user'] : [];

        return CompanyUser::fromArray($data);
    }

    public function delete(int $companyUserId): void
    {
        $this->http->request('DELETE', 'company_users/' . $companyUserId);
    }
}
