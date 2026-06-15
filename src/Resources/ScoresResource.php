<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\VehicleScores;

final class ScoresResource extends AbstractResource
{
    public function getForVehicle(int $vehicleId, string $fromDate, string $toDate): VehicleScores
    {
        $response = $this->http->request('GET', 'vehicles/'.$vehicleId.'/scores_for_period', [
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ]);

        /** @var array<string, mixed> $data */
        $data = is_array($response['scores'] ?? null) ? $response['scores'] : [];

        return VehicleScores::fromArray($data);
    }
}
