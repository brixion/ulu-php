<?php

declare(strict_types=1);

namespace Brixion\Ulu\Http;

use Brixion\Ulu\Exception\ApiException;
use Brixion\Ulu\Exception\AuthenticationException;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

final class HttpClient
{
    public const DEFAULT_BASE_URL = 'https://api.ulu.io/api/v1';

    private ?string $token = null;

    public function __construct(
        private readonly ClientInterface $client,
        private readonly string $baseUrl = self::DEFAULT_BASE_URL,
    ) {
    }

    public static function create(?string $baseUrl = null): self
    {
        return new self(new Client(), $baseUrl ?? self::DEFAULT_BASE_URL);
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * @param array<string, mixed>|null $json
     * @param array<string, scalar|null> $query
     * @return array<string, mixed>
     */
    public function request(
        string $method,
        string $path,
        ?array $json = null,
        array $query = [],
        bool $authenticated = true,
    ): array {
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
        ];

        if ($query !== []) {
            $options['query'] = RequestBuilder::query($query);
        }

        if ($json !== null) {
            $options['json'] = $json;
        }

        if ($authenticated && $this->token !== null) {
            $options['headers']['Authorization'] = 'Token token='.$this->token;
        }

        try {
            $response = $this->client->request($method, rtrim($this->baseUrl, '/').'/'.ltrim($path, '/'), $options);
        } catch (GuzzleException $exception) {
            throw new ApiException('HTTP request failed: '.$exception->getMessage(), 0, [], $exception);
        }

        return $this->decodeResponse($response);
    }

    /**
     * @param array<string, string> $formParams
     * @return array<string, mixed>
     */
    public function requestForm(
        string $method,
        string $url,
        array $formParams,
        bool $authenticated = true,
    ): array {
        $options = [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'form_params' => $formParams,
            'http_errors' => false,
        ];

        if ($authenticated && $this->token !== null) {
            $options['headers']['Authorization'] = 'Token token='.$this->token;
        }

        try {
            $response = $this->client->request($method, $url, $options);
        } catch (GuzzleException $exception) {
            throw new ApiException('HTTP request failed: '.$exception->getMessage(), 0, [], $exception);
        }

        return $this->decodeResponse($response);
    }

    /**
     * @return array<string, mixed>
     */
    private function decodeResponse(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $body = (string) $response->getBody();

        if ($body === '') {
            if ($statusCode >= 400) {
                $this->throwForStatus($statusCode, []);
            }

            return ['success' => true];
        }

        /** @var array<string, mixed>|null $decoded */
        $decoded = json_decode($body, true);

        if (! is_array($decoded)) {
            throw new ApiException('Invalid JSON response from ULU API.', $statusCode);
        }

        if ($statusCode >= 400) {
            $this->throwForStatus($statusCode, $decoded);
        }

        if (array_key_exists('success', $decoded) && $decoded['success'] === false) {
            /** @var array<string, mixed> $errors */
            $errors = is_array($decoded['errors'] ?? null) ? $decoded['errors'] : [];

            throw new ApiException('ULU API request failed.', $statusCode, $errors);
        }

        return $decoded;
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function throwForStatus(int $statusCode, array $payload): never
    {
        /** @var array<string, mixed> $errors */
        $errors = is_array($payload['errors'] ?? null) ? $payload['errors'] : [];
        $message = is_string($payload['message'] ?? null)
            ? $payload['message']
            : 'ULU API request failed with HTTP '.$statusCode;

        if ($statusCode === 401 || $statusCode === 403) {
            throw new AuthenticationException($message, $statusCode, $errors);
        }

        throw new ApiException($message, $statusCode, $errors);
    }
}
