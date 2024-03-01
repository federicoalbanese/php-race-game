<?php

namespace Race;

use Race\DTO\PlayerVehicleDTO;

class RaceGame
{
    private array $playerVehicleDto;

    /**
     * @param \Race\DTO\PlayerVehicleDTO $playerVehicleDTO
     *
     * @return $this
     */
    public function addPlayerVehicle(PlayerVehicleDTO $playerVehicleDTO): self
    {
        $this->playerVehicleDto[] = $playerVehicleDTO;

        return $this;
    }

    /**
     * @return array
     */
    public function play(): array
    {
        return [];
    }
}