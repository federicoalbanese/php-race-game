<?php

namespace Race;

use Race\Entities\Player;

class RacingGame
{
    private array $player;

    /**
     * @param Player $player
     *
     * @return $this
     */
    public function addPlayer(Player $player): self
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