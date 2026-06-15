<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class VehicleError
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?int $vehicleId,
        public ?int $deviceId,
        public ?string $code,
        public ?string $description,
        public ?string $status,
        public ?string $startStatus,
        public ?\DateTimeImmutable $clearedAt,
        public ?\DateTimeImmutable $lastOccurrenceAt,
        public ?int $countForPeriod,
        public ?string $vehicleErrorDescription,
        public ?\DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $updatedAt,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: self::int($data, 'id'),
            vehicleId: self::int($data, 'vehicle_id'),
            deviceId: self::int($data, 'device_id'),
            code: self::string($data, 'code'),
            description: self::string($data, 'description'),
            status: self::string($data, 'status'),
            startStatus: self::string($data, 'start_status'),
            clearedAt: self::dateTime($data, 'cleared_at'),
            lastOccurrenceAt: self::dateTime($data, 'last_occurrence_at'),
            countForPeriod: self::int($data, 'count_for_period'),
            vehicleErrorDescription: self::string($data, 'vehicle_error_description'),
            createdAt: self::dateTime($data, 'created_at'),
            updatedAt: self::dateTime($data, 'updated_at'),
        );
    }

    /**
     * @param list<mixed> $items
     * @return list<self>
     */
    public static function listFromResponse(array $items): array
    {
        return self::mapList($items, self::fromArray(...));
    }
}
