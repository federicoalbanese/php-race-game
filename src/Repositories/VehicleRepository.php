<?php

namespace Race\Repositories;

use Race\DTO\VehicleDTO;

class VehicleRepository
{
    private array $vehicles = [];

    public function __construct()
    {
        $vehicles = json_decode(file_get_contents(__DIR__.'/../../vehicles.json'), true);

        foreach ($vehicles as $index => $vehicle) {
            $this->vehicles[$index] = VehicleDTO::fromArray($vehicle);
        }
    }

    public function get(): array
    {
        return $this->vehicles;
    }

    public function find(int $index): ?VehicleDTO
    {
        return $this->vehicles[$index] ?? null;
    }
}