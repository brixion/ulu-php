<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class CompanyUserGroup
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?int $companyUserId,
        public ?int $companyGroupId,
        public ?bool $isAdmin,
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: self::int($data, 'id'),
            companyUserId: self::int($data, 'company_user_id'),
            companyGroupId: self::int($data, 'company_group_id'),
            isAdmin: self::bool($data, 'is_admin'),
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
