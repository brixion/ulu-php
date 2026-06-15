<?php

declare(strict_types=1);

namespace Brixion\Ulu\Exception;

class ApiException extends UluException
{
    /**
     * @param array<string, mixed> $errors
     */
    public function __construct(
        string $message,
        private readonly int $statusCode = 0,
        private readonly array $errors = [],
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array<string, mixed>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
