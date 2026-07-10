<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class Ibutton
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?string $name,
        public ?string $serialNumber,
        public ?int $companyId,
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
            name: self::string($data, 'name'),
            serialNumber: self::string($data, 'serial_number'),
            companyId: self::int($data, 'company_id'),
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
