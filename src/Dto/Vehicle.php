<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class Vehicle
{
    use MapsApiAttributes;

    /**
     * @param list<VehicleError>|null $vehicleErrors
     * @param list<array<string, mixed>>|null $companyGroups
     */
    public function __construct(
        public ?int $id,
        public ?string $vin,
        public ?int $modelyear,
        public ?string $make,
        public ?string $model,
        public ?string $manufacturedin,
        public ?string $enginetype,
        public ?string $transmission,
        public ?string $driveline,
        public ?string $steeringtype,
        public ?int $seating,
        public ?string $vehicleClass,
        public ?string $vehicleType,
        public ?string $tripScore,
        public ?int $deviceId,
        public ?string $color,
        public ?string $licensePlate,
        public ?string $privacy,
        public ?int $tripTypeId,
        public ?string $name,
        public ?string $state,
        public ?string $country,
        public ?string $fuelLevel,
        public ?string $batteryLevel,
        public ?string $lon,
        public ?string $lat,
        public ?int $speed,
        public ?string $osmPlace,
        public ?string $osmCountry,
        public ?string $osmRoadName,
        public ?string $timezone,
        public ?int $obdOdometer,
        public ?int $companyId,
        public ?int $userId,
        public ?int $odometer,
        public ?int $tripNo,
        public ?int $ownerUserId,
        public ?int $ownerCompanyId,
        public ?int $rpm,
        public ?int $driverId,
        public ?string $location,
        public ?bool $engineState,
        public ?int $virtualOdometer,
        public ?int $version,
        public ?int $nextServiceOdometerTriggerOn,
        public ?int $lastServiceOdometerTriggerOn,
        public ?string $enginetype2,
        public ?int $numberOfCylinders,
        public ?int $cylinderContent,
        public ?int $weightEmptyVehicle,
        public ?int $numberOfDoors,
        public ?int $power,
        public ?string $emissionCode,
        public ?string $fuelConsumptionUrban,
        public ?string $fuelConsumptionExtraurban,
        public ?string $fuelConsumptionCombined,
        public ?string $co2EmissionCombined,
        public ?int $topspeed,
        public ?\DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $updatedAt,
        public ?\DateTimeImmutable $updatedOdometerAt,
        public ?\DateTimeImmutable $heartbeatAt,
        public ?\DateTimeImmutable $heartbeat,
        public ?\DateTimeImmutable $deviceFirstDataAt,
        public ?\DateTimeImmutable $nextPredictionServiceOn,
        public ?\DateTimeImmutable $nextServiceOn,
        public ?\DateTimeImmutable $lastServiceOn,
        public ?\DateTimeImmutable $nextVehicleInspectionDate,
        public ?\DateTimeImmutable $datetimeService,
        public ?\DateTimeImmutable $datetimeOilChange,
        public ?\DateTimeImmutable $datetimeTireRotation,
        public ?\DateTimeImmutable $datetimeRegistration,
        public ?array $vehicleErrors,
        public ?array $companyGroups,
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $errors = self::array($data, 'vehicle_errors');

        return new self(
            id: self::int($data, 'id'),
            vin: self::string($data, 'vin'),
            modelyear: self::int($data, 'modelyear'),
            make: self::string($data, 'make'),
            model: self::string($data, 'model'),
            manufacturedin: self::string($data, 'manufacturedin'),
            enginetype: self::string($data, 'enginetype'),
            transmission: self::string($data, 'transmission'),
            driveline: self::string($data, 'driveline'),
            steeringtype: self::string($data, 'steeringtype'),
            seating: self::int($data, 'seating'),
            vehicleClass: self::string($data, 'vehicle_class'),
            vehicleType: self::string($data, 'vehicle_type'),
            tripScore: self::string($data, 'trip_score'),
            deviceId: self::int($data, 'device_id'),
            color: self::string($data, 'color'),
            licensePlate: self::string($data, 'license_plate'),
            privacy: self::string($data, 'privacy'),
            tripTypeId: self::int($data, 'trip_type_id'),
            name: self::string($data, 'name'),
            state: self::string($data, 'state'),
            country: self::string($data, 'country'),
            fuelLevel: self::string($data, 'fuel_level'),
            batteryLevel: self::string($data, 'battery_level'),
            lon: self::string($data, 'lon'),
            lat: self::string($data, 'lat'),
            speed: self::int($data, 'speed'),
            osmPlace: self::string($data, 'osm_place'),
            osmCountry: self::string($data, 'osm_country'),
            osmRoadName: self::string($data, 'osm_road_name'),
            timezone: self::string($data, 'timezone'),
            obdOdometer: self::int($data, 'obd_odometer'),
            companyId: self::int($data, 'company_id'),
            userId: self::int($data, 'user_id'),
            odometer: self::int($data, 'odometer'),
            tripNo: self::int($data, 'trip_no'),
            ownerUserId: self::int($data, 'owner_user_id'),
            ownerCompanyId: self::int($data, 'owner_company_id'),
            rpm: self::int($data, 'rpm'),
            driverId: self::int($data, 'driver_id'),
            location: self::string($data, 'location'),
            engineState: self::bool($data, 'engine_state'),
            virtualOdometer: self::int($data, 'virtual_odometer'),
            version: self::int($data, 'version'),
            nextServiceOdometerTriggerOn: self::int($data, 'next_service_odometer_trigger_on'),
            lastServiceOdometerTriggerOn: self::int($data, 'last_service_odometer_trigger_on'),
            enginetype2: self::string($data, 'enginetype2'),
            numberOfCylinders: self::int($data, 'number_of_cylinders'),
            cylinderContent: self::int($data, 'cylinder_content'),
            weightEmptyVehicle: self::int($data, 'weight_empty_vehicle'),
            numberOfDoors: self::int($data, 'number_of_doors'),
            power: self::int($data, 'power'),
            emissionCode: self::string($data, 'emission_code'),
            fuelConsumptionUrban: self::string($data, 'fuel_consumption_urban'),
            fuelConsumptionExtraurban: self::string($data, 'fuel_consumption_extraurban'),
            fuelConsumptionCombined: self::string($data, 'fuel_consumption_combined'),
            co2EmissionCombined: self::string($data, 'co2_emission_combined'),
            topspeed: self::int($data, 'topspeed'),
            createdAt: self::dateTime($data, 'created_at'),
            updatedAt: self::dateTime($data, 'updated_at'),
            updatedOdometerAt: self::dateTime($data, 'updated_odometer_at'),
            heartbeatAt: self::dateTime($data, 'heartbeat_at'),
            heartbeat: self::dateTime($data, 'heartbeat'),
            deviceFirstDataAt: self::dateTime($data, 'device_first_data_at'),
            nextPredictionServiceOn: self::dateTime($data, 'next_prediction_service_on'),
            nextServiceOn: self::dateTime($data, 'next_service_on'),
            lastServiceOn: self::dateTime($data, 'last_service_on'),
            nextVehicleInspectionDate: self::dateTime($data, 'next_vehicle_inspection_date'),
            datetimeService: self::dateTime($data, 'datetime_service'),
            datetimeOilChange: self::dateTime($data, 'datetime_oil_change'),
            datetimeTireRotation: self::dateTime($data, 'datetime_tire_rotation'),
            datetimeRegistration: self::dateTime($data, 'datetime_registration'),
            vehicleErrors: $errors !== null
                ? VehicleError::listFromResponse($errors)
                : null,
            companyGroups: self::array($data, 'company_groups'),
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
