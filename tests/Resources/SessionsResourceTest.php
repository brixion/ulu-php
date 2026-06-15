<?php

declare(strict_types=1);

namespace Brixion\Ulu\Tests\Resources;

use Brixion\Ulu\Tests\TestCase;

final class SessionsResourceTest extends TestCase
{
    public function testCreateReturnsSessionWithTokenAndUser(): void
    {
        $client = $this->createClientWithResponses(
            $this->jsonResponse($this->loadFixture('session')),
        );

        $session = $client->sessions()->create('user@example.com', 'secret');

        self::assertSame('98cb262acd66651ad100bf9c6b04bad8', $session->accessToken->accessToken);
        self::assertSame(548, $session->user->id);
        self::assertSame('g7424053@trbvm.com', $session->user->email);
    }

    public function testWithTokenFactory(): void
    {
        $client = \Brixion\Ulu\UluClient::withToken('my-token');

        self::assertSame('my-token', $client->getAccessToken());
    }
}
