<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Http\HttpClient;

abstract class AbstractResource
{
    public function __construct(
        protected readonly HttpClient $http,
    ) {
    }
}
