<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class CompanyUser
{
    use MapsApiAttributes;

    public function __construct(
        public ?int $id,
        public ?string $role,
        public ?bool $deleted,
        public ?string $currentVehicle,
        public ?string $currentCompanyGroups,
        public ?int $customCompanyRoleId,
        public ?int $currentCompanyUserSchedule,
        public ?string $username,
        public ?bool $hasAppAccess,
        public ?int $available,
        public ?User $user,
        public ?\DateTimeImmutable $createdAt,
        public ?\DateTimeImmutable $updatedAt,
    ) {}

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $userData = $data['user'] ?? null;
        $user = is_array($userData) ? User::fromArray($userData) : null;

        return new self(
            id: self::int($data, 'id'),
            role: self::string($data, 'role'),
            deleted: self::bool($data, 'deleted'),
            currentVehicle: self::string($data, 'current_vehicle'),
            currentCompanyGroups: self::string($data, 'current_company_groups'),
            customCompanyRoleId: self::int($data, 'custom_company_role_id'),
            currentCompanyUserSchedule: self::int($data, 'current_company_user_schedule'),
            username: self::string($data, 'username'),
            hasAppAccess: self::bool($data, 'has_app_access'),
            available: self::int($data, 'available'),
            user: $user,
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
