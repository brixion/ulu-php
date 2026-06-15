<?php

declare(strict_types=1);

namespace Brixion\Ulu\Tests;

use Brixion\Ulu\Http\HttpClient;
use Brixion\Ulu\UluClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function createClientWithResponses(Response ...$responses): UluClient
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $guzzle = new Client(['handler' => $handler]);
        $http = new HttpClient($guzzle);

        return new UluClient($http);
    }

    protected function jsonResponse(array $data, int $status = 200): Response
    {
        return new Response($status, ['Content-Type' => 'application/json'], json_encode($data, JSON_THROW_ON_ERROR));
    }

    protected function loadFixture(string $name): array
    {
        $path = __DIR__.'/Fixtures/'.$name.'.json';
        $contents = file_get_contents($path);

        if ($contents === false) {
            self::fail('Fixture not found: '.$name);
        }

        /** @var array<string, mixed> $decoded */
        $decoded = json_decode($contents, true, flags: JSON_THROW_ON_ERROR);

        return $decoded;
    }
}
