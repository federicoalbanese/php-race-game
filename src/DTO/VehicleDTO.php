<?php

namespace Race\DTO;

class VehicleDTO
{
    public function __construct(
        private readonly string $name,
        private readonly int $speed,
        private readonly string $unit,
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSpeed(): float
    {
        return $this->speed;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public static function fromArray(array $vehicle): self
    {
        return new self(
            $vehicle['name'],
            $vehicle['maxSpeed'],
            $vehicle['unit']
        );
    }
}