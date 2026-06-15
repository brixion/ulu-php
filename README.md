# brixion/ulu-php

Typed PHP SDK for the [ULU API](https://driveulu.github.io/api/) (CarTracker fleet tracking).

## Requirements

- PHP 8.2+
- Composer

## Installation

```bash
composer require brixion/ulu-php
```

For local development from this repository:

```bash
composer install
```

## Quick start

### Authenticate with email and password

```php
use Brixion\Ulu\UluClient;

$ulu = UluClient::authenticate('user@example.com', 'your-password');
$token = $ulu->getAccessToken();
```

### Use an existing API token

```php
use Brixion\Ulu\UluClient;

$ulu = UluClient::withToken(getenv('ULU_TOKEN'));
```

### Fetch company, vehicles, and trips

```php
$company = $ulu->companies()->me();
echo $company->name;

$vehicles = $ulu->vehicles()->list(page: 1, limit: 50);
foreach ($vehicles->items as $vehicle) {
    echo $vehicle->licensePlate;
}

$trips = $ulu->trips()->listForVehicle(
    vehicleId: 1376,
    fromStartAt: '2017-02-23T00:00',
    toStartAt: '2017-02-24T00:00',
);

$trip = $ulu->trips()->get(242070);
echo $trip->distance;
```

## API coverage

All documented ULU API v1 endpoints are available through resource services on `UluClient`:

| Resource | Methods |
|----------|---------|
| `sessions()` | `create()` |
| `companies()` | `me()`, `get()`, `list()`, `create()`, `update()`, `delete()` |
| `users()` | `create()`, `resetPassword()`, `changePassword()` |
| `companyUsers()` | `list()`, `get()`, `create()`, `delete()` |
| `companyGroups()` | `create()`, `update()`, `list()`, `get()`, `delete()` |
| `companyUserGroups()` | `create()`, `update()`, `list()`, `get()`, `delete()` |
| `vehicleCompanyGroups()` | `create()`, `list()`, `get()`, `delete()` |
| `ibuttons()` | `create()`, `update()`, `list()`, `get()`, `delete()` |
| `userIbuttons()` | `create()`, `update()`, `list()`, `get()`, `delete()` |
| `devices()` | `list()` |
| `vehicles()` | `list()`, `get()`, `create()`, `update()`, `disconnect()`, `delete()` |
| `scores()` | `getForVehicle()` |
| `vehicleErrors()` | `listForVehicle()` |
| `trips()` | `listForVehicle()`, `get()`, `createFromTracker()`, `tripTypes()`, `tripPoints()` |
| `hotspots()` | `list()` |

## Error handling

API failures throw `Brixion\Ulu\Exception\ApiException`. Authentication problems throw `AuthenticationException`.

```php
use Brixion\Ulu\Exception\ApiException;

try {
    $ulu->companies()->me();
} catch (ApiException $e) {
    echo $e->getMessage();
    print_r($e->getErrors());
}
```

## Testing

```bash
composer test
composer analyse
```

## License

MIT
