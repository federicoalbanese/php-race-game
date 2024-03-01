<?php

namespace Race\Repositories;

use Race\DTO\VehicleDTO;
use Race\Entities\Vehicle;

class VehicleRepository
{
    private array $vehicles = [];

    public function __construct()
    {
        $vehicles = json_decode(file_get_contents(__DIR__.'/../../vehicles.json'), true);

        foreach ($vehicles as $index => $vehicle) {
            $this->vehicles[$index] = Vehicle::fromArray($vehicle);
        }
    }

    public function get(): array
    {
        return $this->vehicles;
    }

    public function find(int $index): ?Vehicle
    {
        return $this->vehicles[$index] ?? null;
    }
}