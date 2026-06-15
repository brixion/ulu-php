<?php

declare(strict_types=1);

namespace Brixion\Ulu\Tests\Resources;

use Brixion\Ulu\Tests\TestCase;

final class VehiclesResourceTest extends TestCase
{
    public function testGetReturnsVehicleDto(): void
    {
        $client = $this->createClientWithResponses(
            $this->jsonResponse($this->loadFixture('vehicle')),
        );
        $client->setToken('token');

        $vehicle = $client->vehicles()->get(29);

        self::assertSame(29, $vehicle->id);
        self::assertSame('LJUP443', $vehicle->licensePlate);
        self::assertSame('Volvo V50', $vehicle->name);
        self::assertSame(1377700225704, $vehicle->deviceId);
        self::assertFalse($vehicle->engineState);
    }
}
