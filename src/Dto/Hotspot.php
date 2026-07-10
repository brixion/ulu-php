<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class Hotspot
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?int $userId,
        public ?string $name,
        public ?string $lon,
        public ?string $lat,
        public ?int $radius,
        public ?string $roadName,
        public ?string $roadPlace,
        public ?string $roadCountry,
        public ?string $roadZipCode,
        public ?string $roadRegion,
        public ?int $roadHouseNumber,
        public ?int $hotspotTypeId,
        public ?int $entityId,
        public ?string $entityType,
        public ?bool $isPointOfInterest,
        public ?bool $isGeofence,
        public ?bool $isGeofenceNotifyIn,
        public ?bool $isGeofenceNotifyOut,
        public ?bool $customPermittedVehicles,
        public ?string $remarks,
        public ?string $houseNumberExtension,
        public ?bool $showOnMap,
        public ?string $visibleTo,
        public ?string $statusCode,
        public ?string $groupName,
        public ?string $address,
        public ?string $displayName,
        public ?\DateTimeImmutable $startAt,
        public ?\DateTimeImmutable $stopAt,
        public ?\DateTimeImmutable $deletedAt,
        public ?\DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $updatedAt,
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: self::int($data, 'id'),
            userId: self::int($data, 'user_id'),
            name: self::string($data, 'name'),
            lon: self::string($data, 'lon'),
            lat: self::string($data, 'lat'),
            radius: self::int($data, 'radius'),
            roadName: self::string($data, 'road_name'),
            roadPlace: self::string($data, 'road_place'),
            roadCountry: self::string($data, 'road_country'),
            roadZipCode: self::string($data, 'road_zip_code'),
            roadRegion: self::string($data, 'road_region'),
            roadHouseNumber: self::int($data, 'road_house_number'),
            hotspotTypeId: self::int($data, 'hotspot_type_id'),
            entityId: self::int($data, 'entity_id'),
            entityType: self::string($data, 'entity_type'),
            isPointOfInterest: self::bool($data, 'is_point_of_interest'),
            isGeofence: self::bool($data, 'is_geofence'),
            isGeofenceNotifyIn: self::bool($data, 'is_geofence_notify_in'),
            isGeofenceNotifyOut: self::bool($data, 'is_geofence_notify_out'),
            customPermittedVehicles: self::bool($data, 'custom_permitted_vehicles'),
            remarks: self::string($data, 'remarks'),
            houseNumberExtension: self::string($data, 'house_number_extension'),
            showOnMap: self::bool($data, 'show_on_map'),
            visibleTo: self::string($data, 'visible_to'),
            statusCode: self::string($data, 'status_code'),
            groupName: self::string($data, 'group_name'),
            address: self::string($data, 'address'),
            displayName: self::string($data, 'display_name'),
            startAt: self::dateTime($data, 'start_at'),
            stopAt: self::dateTime($data, 'stop_at'),
            deletedAt: self::dateTime($data, 'deleted_at'),
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
