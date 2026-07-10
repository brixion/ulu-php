<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class UserIbutton
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?int $ibuttonId,
        public ?int $userId,
        public ?int $companyUserId,
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
            ibuttonId: self::int($data, 'ibutton_id'),
            userId: self::int($data, 'user_id'),
            companyUserId: self::int($data, 'company_user_id'),
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
