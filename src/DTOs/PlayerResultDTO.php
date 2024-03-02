<?php

namespace Race\DTOs;

class PlayerResultDTO
{
    /**
     * @param  string  $name
     * @param  string  $vehicleName
     * @param  float  $time
     */
    public function __construct(private string $name, private string $vehicleName,private float $time)
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVehicleName(): string
    {
        return $this->vehicleName;
    }

    /**
     * @return float
     */
    public function getTime(): float
    {
        return $this->time;
    }
}