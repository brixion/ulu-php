<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\Session;

final class SessionsResource extends AbstractResource
{
    public function create(string $email, string $password): Session
    {
        $response = $this->http->request('POST', 'sessions', [
            'user' => [
                'email' => $email,
                'password' => $password,
            ],
        ], authenticated: false);

        return Session::fromResponse($response);
    }
}
