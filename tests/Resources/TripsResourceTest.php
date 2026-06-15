<?php

declare(strict_types=1);

namespace Brixion\Ulu\Tests\Resources;

use Brixion\Ulu\Tests\TestCase;

final class TripsResourceTest extends TestCase
{
    public function testGetReturnsTripDto(): void
    {
        $client = $this->createClientWithResponses(
            $this->jsonResponse($this->loadFixture('trip')),
        );
        $client->setToken('token');

        $trip = $client->trips()->get(242070);

        self::assertSame(242070, $trip->id);
        self::assertSame(1376, $trip->vehicleId);
        self::assertSame('7.71', $trip->avgSpeed);
        self::assertSame(589, $trip->distance);
        self::assertSame([], $trip->accelerationEventPoints);
    }

    public function testListForVehicleReturnsTripCollection(): void
    {
        $client = $this->createClientWithResponses(
            $this->jsonResponse($this->loadFixture('trips_list')),
        );
        $client->setToken('token');

        $trips = $client->trips()->listForVehicle(1376, '2017-02-23T00:00', '2017-02-24T00:00');

        self::assertCount(1, $trips);
        self::assertSame(242070, $trips[0]->id);
        self::assertSame(589, $trips[0]->distance);
    }
}
