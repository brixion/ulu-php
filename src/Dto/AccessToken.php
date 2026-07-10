<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class AccessToken
{
    use MapsApiAttributes;

    public function __construct(
        public string $accessToken,
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $token = self::string($data, 'access_token')
            ?? self::string($data, 'authentication_token')
            ?? '';

        return new self($token);
    }

    /**
     * @param array<string, mixed> $response
     */
    public static function fromResponse(array $response): self
    {
        if (isset($response['access_token']) && is_array($response['access_token'])) {
            return self::fromArray($response['access_token']);
        }

        if (isset($response['authentication_token']) && is_array($response['authentication_token'])) {
            return self::fromArray($response['authentication_token']);
        }

        return new self('');
    }
}
