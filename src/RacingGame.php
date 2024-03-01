<?php

namespace Race;

use Exception;
use Race\Entities\Player;
use Race\Entities\Vehicle;
use Race\Enums\Units;

class RacingGame
{
    private array $unitConversionFactors = [
        Units::KM_PER_HOUR->value => 1,
        Units::KNOTS->value => 1.852,
        Units::KTS->value => 1.852,
    ];

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
     * @throws \Exception
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
                'time' => $timeFirstPlayer * 60,
            ],
            'player2' => [
                'name' => $secondPlayer->getName(),
                'vehicle_name' => $secondPlayer->getSelectedVehicle()->getName(),
                'time' => $timeSecondPlayer * 60,
            ],
            'winner' => ($timeFirstPlayer < $timeSecondPlayer) ? $firstPlayer->getName() : $secondPlayer->getName()
        ];
    }

    /**
     * @param Vehicle $vehicle
     * @param int $distance
     *
     * @return float|int
     * @throws \Exception
     */
    private function calculateTime(Vehicle $vehicle, int $distance): float|int
    {
        $speedInKmPerHour = $this->convertSpeedToKmPerHour($vehicle->getMaxSpeed(), $vehicle->getUnit());

        return $distance / $speedInKmPerHour;
    }

    /**
     * @throws \Exception
     */
    private function convertSpeedToKmPerHour(float $speed, string $unit): float
    {
        var_dump($this->unitConversionFactors[$unit]);
        $conversionFactor = $this->unitConversionFactors[$unit] ?? null;

        if ($conversionFactor === null) {
            throw new Exception('Invalid conversion factor for unit: ' . $unit);
        }

        return $speed * $conversionFactor;
    }
}