<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\VehicleError;

final class VehicleErrorsResource extends AbstractResource
{
    /**
     * @return list<VehicleError>
     */
    public function listForVehicle(int $vehicleId): array
    {
        $response = $this->http->request('GET', 'vehicles/' . $vehicleId . '/vehicle_errors');

        /** @var list<mixed> $items */
        $items = is_array($response['vehicle_errors'] ?? null) ? $response['vehicle_errors'] : [];

        return VehicleError::listFromResponse($items);
    }
}
