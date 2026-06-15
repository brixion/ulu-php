<?php

declare(strict_types=1);

namespace Brixion\Ulu\Resources;

use Brixion\Ulu\Dto\Device;

final class DevicesResource extends AbstractResource
{
    /**
     * @return list<Device>
     */
    public function list(?bool $unpaired = null): array
    {
        $query = [];

        if ($unpaired === true) {
            $query['updaired'] = 'True';
        }

        $response = $this->http->request('GET', 'devices', query: $query);

        /** @var list<mixed> $items */
        $items = is_array($response['devices'] ?? null) ? $response['devices'] : [];

        return Device::listFromResponse($items);
    }
}
