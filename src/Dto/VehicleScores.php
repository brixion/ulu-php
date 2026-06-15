<?php

declare(strict_types=1);

namespace Brixion\Ulu\Dto;

use Brixion\Ulu\Dto\Concerns\MapsApiAttributes;

final readonly class ScoreDetail
{
    use MapsApiAttributes;

    public function __construct(
        public ?string $name,
        public ?float $score,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: self::string($data, 'name'),
            score: self::float($data, 'score'),
        );
    }
}

final readonly class VehicleScores
{
    use MapsApiAttributes;

    /**
     * @param list<ScoreDetail> $scores
     */
    public function __construct(
        public ?float $score,
        public array $scores,
        public ?float $previousWeekScore,
        public ?string $tip,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $details = [];
        $rawScores = self::array($data, 'scores') ?? [];

        foreach ($rawScores as $item) {
            if (is_array($item)) {
                $details[] = ScoreDetail::fromArray($item);
            }
        }

        return new self(
            score: self::float($data, 'score'),
            scores: $details,
            previousWeekScore: self::float($data, 'previous_week_score'),
            tip: self::string($data, 'tip'),
        );
    }
}
