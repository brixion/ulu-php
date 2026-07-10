<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class Trip
{
    use MapsApiAttributes;

    /**
     * @param list<TripPoint>|null $accelerationEventPoints
     * @param list<TripPoint>|null $brakingEventPoints
     * @param array<string, mixed>|null $commonTripScores
     * @param list<mixed>|null $pointsVector
     */
    public function __construct(
        public ?int $id,
        public ?int $deviceId,
        public ?int $vehicleId,
        public ?string $privacy,
        public ?int $tripTypeId,
        public ?int $duration,
        public ?int $maxSpeed,
        public ?int $distance,
        public ?int $idleDuration,
        public ?string $avgSpeed,
        public ?string $startRoadName,
        public ?string $startRoadPlace,
        public ?string $startRoadCountry,
        public ?string $stopRoadName,
        public ?string $stopRoadPlace,
        public ?string $stopRoadCountry,
        public ?string $score,
        public ?int $userId,
        public ?int $driverId,
        public ?int $companyId,
        public ?int $maxRpm,
        public ?string $notes,
        public ?string $startLon,
        public ?string $startLat,
        public ?string $stopLon,
        public ?string $stopLat,
        public ?string $startRoadZipCode,
        public ?string $stopRoadZipCode,
        public ?int $odometerStart,
        public ?int $odometerStop,
        public ?int $distanceElectric,
        public ?string $startRoadHouseNumber,
        public ?string $stopRoadHouseNumber,
        public ?string $startRoadRegion,
        public ?string $stopRoadRegion,
        public ?\DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $updatedAt,
        public ?\DateTimeImmutable $utcStartAt,
        public ?\DateTimeImmutable $utcStopAt,
        public ?\DateTimeImmutable $startAt,
        public ?\DateTimeImmutable $stopAt,
        public ?\DateTimeImmutable $deletedAt,
        public ?array $commonTripScores,
        public ?array $pointsVector,
        public ?array $accelerationEventPoints,
        public ?array $brakingEventPoints,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $accelPoints = self::array($data, 'acceleration_event_points');
        $brakePoints = self::array($data, 'braking_event_points');

        return new self(
            id: self::int($data, 'id'),
            deviceId: self::int($data, 'device_id'),
            vehicleId: self::int($data, 'vehicle_id'),
            privacy: self::string($data, 'privacy'),
            tripTypeId: self::int($data, 'trip_type_id'),
            duration: self::int($data, 'duration'),
            maxSpeed: self::int($data, 'max_speed'),
            distance: self::int($data, 'distance'),
            idleDuration: self::int($data, 'idle_duration'),
            avgSpeed: self::string($data, 'avg_speed'),
            startRoadName: self::string($data, 'start_road_name'),
            startRoadPlace: self::string($data, 'start_road_place'),
            startRoadCountry: self::string($data, 'start_road_country'),
            stopRoadName: self::string($data, 'stop_road_name'),
            stopRoadPlace: self::string($data, 'stop_road_place'),
            stopRoadCountry: self::string($data, 'stop_road_country'),
            score: self::string($data, 'score'),
            userId: self::int($data, 'user_id'),
            driverId: self::int($data, 'driver_id'),
            companyId: self::int($data, 'company_id'),
            maxRpm: self::int($data, 'max_rpm'),
            notes: self::string($data, 'notes'),
            startLon: self::string($data, 'start_lon'),
            startLat: self::string($data, 'start_lat'),
            stopLon: self::string($data, 'stop_lon'),
            stopLat: self::string($data, 'stop_lat'),
            startRoadZipCode: self::string($data, 'start_road_zip_code'),
            stopRoadZipCode: self::string($data, 'stop_road_zip_code'),
            odometerStart: self::int($data, 'odometer_start'),
            odometerStop: self::int($data, 'odometer_stop'),
            distanceElectric: self::int($data, 'distance_electric'),
            startRoadHouseNumber: self::string($data, 'start_road_house_number'),
            stopRoadHouseNumber: self::string($data, 'stop_road_house_number'),
            startRoadRegion: self::string($data, 'start_road_region'),
            stopRoadRegion: self::string($data, 'stop_road_region'),
            createdAt: self::dateTime($data, 'created_at'),
            updatedAt: self::dateTime($data, 'updated_at'),
            utcStartAt: self::dateTime($data, 'utc_start_at'),
            utcStopAt: self::dateTime($data, 'utc_stop_at'),
            startAt: self::dateTime($data, 'start_at'),
            stopAt: self::dateTime($data, 'stop_at'),
            deletedAt: self::dateTime($data, 'deleted_at'),
            commonTripScores: self::array($data, 'common_trip_scores'),
            pointsVector: self::array($data, 'points_vector'),
            accelerationEventPoints: $accelPoints !== null
                ? TripPoint::listFromResponse($accelPoints)
                : null,
            brakingEventPoints: $brakePoints !== null
                ? TripPoint::listFromResponse($brakePoints)
                : null,
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
