<?php

namespace Race\DTO;

class PlayerVehicleDTO
{
    public function __construct(private readonly VehicleDTO $vehicleDTO,private readonly int $playerId) { }

    /**
     * @return \Race\DTO\VehicleDTO
     */
    public function getVehicleDTO(): VehicleDTO
    {
        return $this->vehicleDTO;
    }

    /**
     * @return int
     */
    public function getPlayerId(): int
    {
        return $this->playerId;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['vehicle'],
            $data['player_id'],
        );
    }
}