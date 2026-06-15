<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class User
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?string $firstname,
        public ?string $lastname,
        public ?string $name,
        public ?string $email,
        public ?string $sex,
        public ?string $birthday,
        public ?string $address,
        public ?string $housenumber,
        public ?string $city,
        public ?string $phone,
        public ?string $picture,
        public ?string $vatNumber,
        public ?bool $emailVerified,
        public ?string $zipCode,
        public ?string $post,
        public ?string $country,
        public ?string $timezone,
        public ?\DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $updatedAt,
        public ?\DateTimeImmutable $termsAcceptedAt,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: self::int($data, 'id'),
            firstname: self::string($data, 'firstname'),
            lastname: self::string($data, 'lastname'),
            name: self::string($data, 'name'),
            email: self::string($data, 'email'),
            sex: self::string($data, 'sex'),
            birthday: self::string($data, 'birthday'),
            address: self::string($data, 'address'),
            housenumber: self::string($data, 'housenumber'),
            city: self::string($data, 'city'),
            phone: self::string($data, 'phone'),
            picture: self::string($data, 'picture'),
            vatNumber: self::string($data, 'vat_number'),
            emailVerified: self::bool($data, 'email_verified'),
            zipCode: self::string($data, 'zip_code'),
            post: self::string($data, 'post'),
            country: self::string($data, 'country'),
            timezone: self::string($data, 'timezone'),
            createdAt: self::dateTime($data, 'created_at'),
            updatedAt: self::dateTime($data, 'updated_at'),
            termsAcceptedAt: self::dateTime($data, 'terms_accepted_at'),
        );
    }
}
