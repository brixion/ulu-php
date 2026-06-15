<?php

declare(strict_types=1);

namespace Brixion\Ulu;

use Brixion\Ulu\Http\HttpClient;
use Brixion\Ulu\Resources\CompaniesResource;
use Brixion\Ulu\Resources\CompanyGroupsResource;
use Brixion\Ulu\Resources\CompanyUserGroupsResource;
use Brixion\Ulu\Resources\CompanyUsersResource;
use Brixion\Ulu\Resources\DevicesResource;
use Brixion\Ulu\Resources\HotspotsResource;
use Brixion\Ulu\Resources\IbuttonsResource;
use Brixion\Ulu\Resources\ScoresResource;
use Brixion\Ulu\Resources\SessionsResource;
use Brixion\Ulu\Resources\TripsResource;
use Brixion\Ulu\Resources\UserIbuttonsResource;
use Brixion\Ulu\Resources\UsersResource;
use Brixion\Ulu\Resources\VehicleCompanyGroupsResource;
use Brixion\Ulu\Resources\VehicleErrorsResource;
use Brixion\Ulu\Resources\VehiclesResource;
use GuzzleHttp\ClientInterface;

final class UluClient
{
    private readonly HttpClient $http;

    private ?SessionsResource $sessions = null;
    private ?CompaniesResource $companies = null;
    private ?UsersResource $users = null;
    private ?CompanyUsersResource $companyUsers = null;
    private ?CompanyGroupsResource $companyGroups = null;
    private ?CompanyUserGroupsResource $companyUserGroups = null;
    private ?VehicleCompanyGroupsResource $vehicleCompanyGroups = null;
    private ?IbuttonsResource $ibuttons = null;
    private ?UserIbuttonsResource $userIbuttons = null;
    private ?DevicesResource $devices = null;
    private ?VehiclesResource $vehicles = null;
    private ?ScoresResource $scores = null;
    private ?VehicleErrorsResource $vehicleErrors = null;
    private ?TripsResource $trips = null;
    private ?HotspotsResource $hotspots = null;

    public function __construct(
        ?HttpClient $http = null,
        ?string $baseUrl = null,
        ?ClientInterface $guzzleClient = null,
    ) {
        if ($http !== null) {
            $this->http = $http;
        } elseif ($guzzleClient !== null) {
            $this->http = new HttpClient($guzzleClient, $baseUrl ?? HttpClient::DEFAULT_BASE_URL);
        } else {
            $this->http = HttpClient::create($baseUrl);
        }
    }

    public static function withToken(string $token, ?string $baseUrl = null): self
    {
        $client = new self(baseUrl: $baseUrl);
        $client->setToken($token);

        return $client;
    }

    public static function authenticate(string $email, string $password, ?string $baseUrl = null): self
    {
        $client = new self(baseUrl: $baseUrl);
        $session = $client->sessions()->create($email, $password);
        $client->setToken($session->accessToken->accessToken);

        return $client;
    }

    public function getAccessToken(): ?string
    {
        return $this->http->getToken();
    }

    public function setToken(?string $token): self
    {
        $this->http->setToken($token);

        return $this;
    }

    public function http(): HttpClient
    {
        return $this->http;
    }

    public function sessions(): SessionsResource
    {
        return $this->sessions ??= new SessionsResource($this->http);
    }

    public function companies(): CompaniesResource
    {
        return $this->companies ??= new CompaniesResource($this->http);
    }

    public function users(): UsersResource
    {
        return $this->users ??= new UsersResource($this->http);
    }

    public function companyUsers(): CompanyUsersResource
    {
        return $this->companyUsers ??= new CompanyUsersResource($this->http);
    }

    public function companyGroups(): CompanyGroupsResource
    {
        return $this->companyGroups ??= new CompanyGroupsResource($this->http);
    }

    public function companyUserGroups(): CompanyUserGroupsResource
    {
        return $this->companyUserGroups ??= new CompanyUserGroupsResource($this->http);
    }

    public function vehicleCompanyGroups(): VehicleCompanyGroupsResource
    {
        return $this->vehicleCompanyGroups ??= new VehicleCompanyGroupsResource($this->http);
    }

    public function ibuttons(): IbuttonsResource
    {
        return $this->ibuttons ??= new IbuttonsResource($this->http);
    }

    public function userIbuttons(): UserIbuttonsResource
    {
        return $this->userIbuttons ??= new UserIbuttonsResource($this->http);
    }

    public function devices(): DevicesResource
    {
        return $this->devices ??= new DevicesResource($this->http);
    }

    public function vehicles(): VehiclesResource
    {
        return $this->vehicles ??= new VehiclesResource($this->http);
    }

    public function scores(): ScoresResource
    {
        return $this->scores ??= new ScoresResource($this->http);
    }

    public function vehicleErrors(): VehicleErrorsResource
    {
        return $this->vehicleErrors ??= new VehicleErrorsResource($this->http);
    }

    public function trips(): TripsResource
    {
        return $this->trips ??= new TripsResource($this->http);
    }

    public function hotspots(): HotspotsResource
    {
        return $this->hotspots ??= new HotspotsResource($this->http);
    }
}
