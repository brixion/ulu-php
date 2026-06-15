<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

final readonly class Session
{
    public function __construct(
        public AccessToken $accessToken,
        public User $user,
    ) {
    }

    /**
     * @param array<string, mixed> $response
     */
    public static function fromResponse(array $response): self
    {
        /** @var array<string, mixed> $userData */
        $userData = is_array($response['user'] ?? null) ? $response['user'] : [];

        return new self(
            accessToken: AccessToken::fromResponse($response),
            user: User::fromArray($userData),
        );
    }
}
