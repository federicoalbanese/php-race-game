<?php

namespace Race\Entities;

class Player
{
    public function __construct(
        private readonly string $name,
        private readonly Vehicle $vehicle
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