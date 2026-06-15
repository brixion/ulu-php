<?php

declare(strict_types=1);

namespace Brixion\Ulu\Tests\Resources;

use Brixion\Ulu\Tests\TestCase;

final class CompaniesResourceTest extends TestCase
{
    public function testMeReturnsCompanyDto(): void
    {
        $client = $this->createClientWithResponses(
            $this->jsonResponse($this->loadFixture('company_me')),
        );
        $client->setToken('token');

        $company = $client->companies()->me();

        self::assertSame(548, $company->id);
        self::assertSame('test company', $company->name);
        self::assertSame('NL', $company->country);
        self::assertSame('company_contact@company.com', $company->contactEmail);
    }
}
