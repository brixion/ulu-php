<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class TripPoint
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?int $tripId,
        public ?string $lon,
        public ?string $lat,
        public ?int $speed,
        public ?string $country,
        public ?string $place,
        public ?string $roadName,
        public ?string $roadType,
        public ?int $speedLimit,
        public ?int $distance,
        public ?int $tripObdDuration,
        public ?int $tripIdleDuration,
        public ?string $fuelLevel,
        public ?int $rpm,
        public ?string $batteryVoltage,
        public ?string $speedingIdx,
        public ?int $distanceElectric,
        public ?string $roadLon,
        public ?string $roadLat,
        public ?int $acceleration,
        public ?int $deviceId,
        public ?int $linkId,
        public ?\DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $deviceCreatedAt,
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: self::int($data, 'id'),
            tripId: self::int($data, 'trip_id'),
            lon: self::string($data, 'lon'),
            lat: self::string($data, 'lat'),
            speed: self::int($data, 'speed'),
            country: self::string($data, 'country'),
            place: self::string($data, 'place'),
            roadName: self::string($data, 'road_name'),
            roadType: self::string($data, 'road_type'),
            speedLimit: self::int($data, 'speed_limit'),
            distance: self::int($data, 'distance'),
            tripObdDuration: self::int($data, 'trip_obd_duration'),
            tripIdleDuration: self::int($data, 'trip_idle_duration'),
            fuelLevel: self::string($data, 'fuel_level'),
            rpm: self::int($data, 'rpm'),
            batteryVoltage: self::string($data, 'battery_voltage'),
            speedingIdx: self::string($data, 'speeding_idx'),
            distanceElectric: self::int($data, 'distance_electric'),
            roadLon: self::string($data, 'road_lon'),
            roadLat: self::string($data, 'road_lat'),
            acceleration: self::int($data, 'acceleration'),
            deviceId: self::int($data, 'device_id'),
            linkId: self::int($data, 'link_id'),
            createdAt: self::dateTime($data, 'created_at'),
            deviceCreatedAt: self::dateTime($data, 'device_created_at'),
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
