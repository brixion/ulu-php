<?php

declare(strict_types=1);

namespace Brixion\Ulu\Http;

final class RequestBuilder
{
    /**
     * @param array<string, scalar|null> $params
     */
    public static function path(string $template, array $params = []): string
    {
        $path = $template;

        foreach ($params as $key => $value) {
            if ($value === null) {
                continue;
            }

            $path = str_replace('{' . $key . '}', rawurlencode((string) $value), $path);
        }

        return $path;
    }

    /**
     * @param array<string, scalar|null> $query
     * @return array<string, string>
     */
    public static function query(array $query): array
    {
        $filtered = [];

        foreach ($query as $key => $value) {
            if ($value === null) {
                continue;
            }

            $filtered[$key] = (string) $value;
        }

        return $filtered;
    }
}
