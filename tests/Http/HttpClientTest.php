<?php

declare(strict_types=1);

namespace Brixion\Ulu\Tests\Http;

use Brixion\Ulu\Exception\ApiException;
use Brixion\Ulu\Exception\AuthenticationException;
use Brixion\Ulu\Http\HttpClient;
use Brixion\Ulu\Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

final class HttpClientTest extends TestCase
{
    public function testSuccessfulRequestReturnsDecodedPayload(): void
    {
        $mock = new MockHandler([
            $this->jsonResponse(['success' => true, 'company' => ['id' => 1, 'name' => 'Acme']]),
        ]);
        $http = new HttpClient(new Client(['handler' => HandlerStack::create($mock)]));
        $http->setToken('secret');

        $response = $http->request('GET', 'companies/me');

        self::assertTrue($response['success']);
        self::assertSame(1, $response['company']['id']);
    }

    public function testApiFailureThrowsApiException(): void
    {
        $mock = new MockHandler([
            $this->jsonResponse($this->loadFixture('api_error'), 422),
        ]);
        $http = new HttpClient(new Client(['handler' => HandlerStack::create($mock)]));

        $this->expectException(ApiException::class);

        try {
            $http->request('POST', 'update_user_password', ['user' => []], authenticated: false);
        } catch (ApiException $exception) {
            self::assertArrayHasKey('old_password', $exception->getErrors());

            throw $exception;
        }
    }

    public function testUnauthorizedThrowsAuthenticationException(): void
    {
        $mock = new MockHandler([
            $this->jsonResponse(['success' => false, 'errors' => []], 401),
        ]);
        $http = new HttpClient(new Client(['handler' => HandlerStack::create($mock)]));
        $http->setToken('bad-token');

        $this->expectException(AuthenticationException::class);
        $http->request('GET', 'companies/me');
    }

    public function testGetWithJsonBodyIsSupported(): void
    {
        $mock = new MockHandler([
            $this->jsonResponse(['success' => true, 'trips' => []]),
        ]);
        $http = new HttpClient(new Client(['handler' => HandlerStack::create($mock)]));
        $http->setToken('secret');

        $response = $http->request('GET', 'vehicles/1/trips', [
            'from_start_at' => '2017-02-23T00:00',
            'to_start_at' => '2017-02-24T00:00',
        ]);

        self::assertSame([], $response['trips']);
    }
}
