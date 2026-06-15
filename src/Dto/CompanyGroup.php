<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class CompanyGroup
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?int $companyId,
        public ?string $name,
        public ?string $color,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: self::int($data, 'id'),
            companyId: self::int($data, 'company_id'),
            name: self::string($data, 'name'),
            color: self::string($data, 'color'),
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
