<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\AccessToken;
use Brixion\Ulu\Dto\Company;
use Brixion\Ulu\Dto\User;

final class CompaniesResource extends AbstractResource
{
    public function me(): Company
    {
        $response = $this->http->request('GET', 'companies/me');

        /** @var array<string, mixed> $company */
        $company = is_array($response['company'] ?? null) ? $response['company'] : [];

        return Company::fromArray($company);
    }

    public function get(int $companyId): Company
    {
        $response = $this->http->request('GET', 'companies/' . $companyId);

        /** @var array<string, mixed> $company */
        $company = is_array($response['company'] ?? null) ? $response['company'] : [];

        return Company::fromArray($company);
    }

    /**
     * @return list<Company>
     */
    public function list(): array
    {
        $response = $this->http->request('GET', 'companies/');

        /** @var list<mixed> $companies */
        $companies = is_array($response['companies'] ?? null) ? $response['companies'] : [];

        return Company::listFromResponse($companies);
    }

    /**
     * @param array<string, mixed> $company
     * @param array<string, mixed> $user
     * @return array{company: list<Company>, user: list<User>, token: AccessToken}
     */
    public function create(array $company, array $user): array
    {
        $response = $this->http->request('POST', 'companies', [
            'company' => $company,
            'user' => $user,
        ]);

        /** @var list<mixed> $companies */
        $companies = is_array($response['company'] ?? null) ? $response['company'] : [];
        /** @var list<mixed> $users */
        $users = is_array($response['user'] ?? null) ? $response['user'] : [];

        return [
            'company' => Company::listFromResponse($companies),
            'user' => array_map(
                static fn(array $data): User => User::fromArray($data),
                array_filter($users, 'is_array'),
            ),
            'token' => AccessToken::fromResponse($response),
        ];
    }

    /**
     * @param array<string, mixed> $company
     * @return list<Company>
     */
    public function update(int $companyId, array $company): array
    {
        $response = $this->http->request('PUT', 'companies/' . $companyId, [
            'company' => $company,
        ]);

        /** @var list<mixed> $companies */
        $companies = is_array($response['company'] ?? null) ? $response['company'] : [];

        return Company::listFromResponse($companies);
    }

    /**
     * @return list<Company>
     */
    public function delete(int $companyId): array
    {
        $response = $this->http->request('DELETE', 'companies/' . $companyId);

        /** @var list<mixed> $companies */
        $companies = is_array($response['company'] ?? null) ? $response['company'] : [];

        return Company::listFromResponse($companies);
    }
}
