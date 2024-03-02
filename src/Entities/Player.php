<?php

namespace Race\Entities;

readonly class Player
{
    public function __construct(
        private string $name,
        private Vehicle $vehicle
    )
    {
    }

    public function getSelectedVehicle(): Vehicle
    {
        return $this->vehicle;
    }

    public function getName(): string
    {
        return $this->name;
    }
}