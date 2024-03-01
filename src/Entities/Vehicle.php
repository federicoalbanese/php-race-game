<?php

namespace Race\Entities;

class Vehicle
{
    public function __construct(
        private readonly string $name,
        private readonly int $maxSpeed,
        private readonly string $unit,
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getMaxSpeed(): int
    {
        return $this->maxSpeed;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param array $vehicle
     *
     * @return self
     */
    public static function fromArray(array $vehicle): self
    {
        return new self(
            $vehicle['name'],
            $vehicle['maxSpeed'],
            $vehicle['unit']
        );
    }
}