<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto\Concerns;

trait MapsApiAttributes
{
    /**
     * @param array<string, mixed> $data
     */
    protected static function string(array $data, string $key): ?string
    {
        if (! array_key_exists($key, $data) || $data[$key] === null) {
            return null;
        }

        return (string) $data[$key];
    }

    /**
     * @param array<string, mixed> $data
     */
    protected static function int(array $data, string $key): ?int
    {
        if (! array_key_exists($key, $data) || $data[$key] === null) {
            return null;
        }

        return (int) $data[$key];
    }

    /**
     * @param array<string, mixed> $data
     */
    protected static function float(array $data, string $key): ?float
    {
        if (! array_key_exists($key, $data) || $data[$key] === null) {
            return null;
        }

        return (float) $data[$key];
    }

    /**
     * @param array<string, mixed> $data
     */
    protected static function bool(array $data, string $key): ?bool
    {
        if (! array_key_exists($key, $data) || $data[$key] === null) {
            return null;
        }

        return (bool) $data[$key];
    }

    /**
     * @param array<string, mixed> $data
     * @return array<mixed>|null
     */
    protected static function array(array $data, string $key): ?array
    {
        if (! array_key_exists($key, $data) || $data[$key] === null) {
            return null;
        }

        $value = $data[$key];

        return is_array($value) ? $value : null;
    }

    /**
     * @param array<string, mixed> $data
     * @param string ...$keys
     */
    protected static function dateTime(array $data, string ...$keys): ?\DateTimeImmutable
    {
        foreach ($keys as $key) {
            $value = self::string($data, $key);

            if ($value === null || $value === '') {
                continue;
            }

            try {
                return new \DateTimeImmutable($value);
            } catch (\Exception) {
                continue;
            }
        }

        return null;
    }

    /**
     * @param list<mixed> $items
     * @param callable(array<string, mixed>): T $mapper
     * @return list<T>
     *
     * @template T
     */
    protected static function mapList(array $items, callable $mapper): array
    {
        $result = [];

        foreach ($items as $item) {
            if (! is_array($item)) {
                continue;
            }

            $normalized = $item;

            foreach (['company', 'user', 'vehicle', 'trip', 'company_user', 'company_group', 'company_user_group', 'vehicle_company_group', 'ibutton', 'user_ibutton', 'device'] as $wrapper) {
                if (isset($normalized[$wrapper]) && is_array($normalized[$wrapper])) {
                    /** @var array<string, mixed> $normalized */
                    $normalized = $normalized[$wrapper];
                    break;
                }
            }

            /** @var array<string, mixed> $normalized */
            $result[] = $mapper($normalized);
        }

        return $result;
    }
}
