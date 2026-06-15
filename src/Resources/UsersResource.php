<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\User;

final class UsersResource extends AbstractResource
{
    /**
     * @param array<string, mixed> $user
     */
    public function create(array $user): User
    {
        $response = $this->http->request('POST', 'users', [
            'user' => $user,
        ], authenticated: false);

        /** @var array<string, mixed> $userData */
        $userData = is_array($response['user'] ?? null) ? $response['user'] : [];

        return User::fromArray($userData);
    }

    public function resetPassword(string $email): User
    {
        $response = $this->http->request('POST', 'reset_password', [
            'user' => ['email' => $email],
        ], authenticated: false);

        /** @var array<string, mixed> $userData */
        $userData = is_array($response['user'] ?? null) ? $response['user'] : [];

        return User::fromArray($userData);
    }

    /**
     * @param array<string, mixed> $user
     */
    public function changePassword(int $userId, array $user): User
    {
        $response = $this->http->request('POST', 'update_user_password', [
            'user' => $user,
            'id' => $userId,
        ], authenticated: false);

        /** @var array<string, mixed> $userData */
        $userData = is_array($response['user'] ?? null) ? $response['user'] : [];

        return User::fromArray($userData);
    }
}
