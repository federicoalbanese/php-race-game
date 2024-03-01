<?php

namespace Race;

use Race\Entities\Player;
use Race\Entities\Vehicle;

class RacingGame
{
    /**
     * @var array<Player>
     */
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
    public function play(int $distance): array
    {
        $firstPlayer = $this->player[0];
        $secondPlayer = $this->player[1];

        $timeFirstPlayer = $this->calculateTime($firstPlayer->getSelectedVehicle(), $distance);
        $timeSecondPlayer = $this->calculateTime($secondPlayer->getSelectedVehicle(), $distance);

        return [
            'player1' => [
                'name' => $firstPlayer->getName(),
                'time' => $timeFirstPlayer,
            ],
            'player2' => [
                'name' => $secondPlayer->getName(),
                'time' => $timeSecondPlayer,
            ],
            'winner' => ($timeFirstPlayer < $timeSecondPlayer) ? $firstPlayer->getName() : $secondPlayer->getName()
        ];
    }

    private function calculateTime(Vehicle $vehicle, int $distance)
    {


    }
}