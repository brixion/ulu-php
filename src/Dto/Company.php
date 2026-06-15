<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class Company
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $email,
        public ?string $timezone,
        public ?string $address,
        public ?string $housenumber,
        public ?string $city,
        public ?string $region,
        public ?string $country,
        public ?string $zipCode,
        public ?string $vatNumber,
        public ?string $registrationNumber,
        public ?string $phone,
        public ?string $contactName,
        public ?string $contactPhone,
        public ?string $contactEmail,
        public ?int $reportTypeId,
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
            name: self::string($data, 'name'),
            email: self::string($data, 'email'),
            timezone: self::string($data, 'timezone'),
            address: self::string($data, 'address'),
            housenumber: self::string($data, 'housenumber'),
            city: self::string($data, 'city'),
            region: self::string($data, 'region'),
            country: self::string($data, 'country'),
            zipCode: self::string($data, 'zip_code'),
            vatNumber: self::string($data, 'vat_number'),
            registrationNumber: self::string($data, 'registration_number'),
            phone: self::string($data, 'phone'),
            contactName: self::string($data, 'contact_name'),
            contactPhone: self::string($data, 'contact_phone'),
            contactEmail: self::string($data, 'contact_email'),
            reportTypeId: self::int($data, 'report_type_id'),
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
