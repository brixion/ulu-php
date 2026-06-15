<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

/**
 * @template T
 */
final readonly class PaginatedList
{
    /**
     * @param list<T> $items
     */
    public function __construct(
        public array $items,
        public ?int $totalPages = null,
        public ?int $currentPage = null,
        public ?bool $hasMore = null,
    ) {
    }

    public function count(): int
    {
        return count($this->items);
    }
}
