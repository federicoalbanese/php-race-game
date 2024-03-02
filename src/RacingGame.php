<?php

namespace Race;

use Exception;
use Race\DTOs\GameResultDTO;
use Race\DTOs\PlayerResultDTO;
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
     * @return GameResultDTO
     * @throws \Exception
     */
    public function runGame(int $distance): GameResultDTO
    {
        $firstPlayer = $this->player[0];
        $secondPlayer = $this->player[1];

        $timeFirstPlayer = $this->calculateTime($firstPlayer->getSelectedVehicle(), $distance);
        $timeSecondPlayer = $this->calculateTime($secondPlayer->getSelectedVehicle(), $distance);
        $winner = ($timeFirstPlayer < $timeSecondPlayer) ? $firstPlayer->getName() : $secondPlayer->getName();

        return (
            new GameResultDTO(
                new PlayerResultDTO(
                        $firstPlayer->getName(),
                        $firstPlayer->getSelectedVehicle()->getName(),
                        $timeFirstPlayer * 60
                ),
                new PlayerResultDTO(
                        $secondPlayer->getName(),
                        $secondPlayer->getSelectedVehicle()->getName(),
                        $timeSecondPlayer * 60
                ),
                $winner
            )
        );
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
        $conversionFactor = $this->unitConversionFactors[$unit] ?? null;

        if ($conversionFactor === null) {
            throw new Exception('Invalid conversion factor for unit: ' . $unit);
        }

        return $speed * $conversionFactor;
    }
}