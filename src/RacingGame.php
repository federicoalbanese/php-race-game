<?php

namespace Race;

use Race\Entities\Player;
use Race\Entities\Vehicle;
use Race\Enums\Units;

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
     * @param int $distance
     *
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
                'vehicle_name' => $firstPlayer->getSelectedVehicle()->getName(),
                'time' => $timeFirstPlayer,
            ],
            'player2' => [
                'name' => $secondPlayer->getName(),
                'vehicle_name' => $secondPlayer->getSelectedVehicle()->getName(),
                'time' => $timeSecondPlayer,
            ],
            'winner' => ($timeFirstPlayer < $timeSecondPlayer) ? $firstPlayer->getName() : $secondPlayer->getName()
        ];
    }

    /**
     * @param Vehicle $vehicle
     * @param int $distance
     *
     * @return float|int
     */
    private function calculateTime(Vehicle $vehicle, int $distance): float|int
    {
        $speed = $vehicle->getMaxSpeed();

        switch ($vehicle->getUnit()){
            case Units::KNOTS->value:
            case Units::KTS->value :
                $speed *= 1.852;
                break;
        }

        return $distance / $speed;
    }
}