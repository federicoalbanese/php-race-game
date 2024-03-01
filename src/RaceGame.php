<?php

namespace Race;

use Race\Entities\Player;

class RaceGame
{
    private array $player;

    /**
     * @param \Race\Entities\Player $player
     *
     * @return $this
     */
    public function addPlayerVehicle(Player $player): self
    {
        $this->player[] = $player;

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