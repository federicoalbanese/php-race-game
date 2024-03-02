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

    public function __construct(private readonly Player $firstPlayer, private readonly Player $secondPlayer)
    {
    }

    /**
     * @param int $distance
     *
     * @return GameResultDTO
     * @throws \Exception
     */
    public function runGame(int $distance): GameResultDTO
    {
        $timeFirstPlayer = $this->calculateTime($this->firstPlayer->getSelectedVehicle(), $distance);
        $timeSecondPlayer = $this->calculateTime($this->secondPlayer->getSelectedVehicle(), $distance);
        $winner = ($timeFirstPlayer < $timeSecondPlayer) ? $this->firstPlayer->getName() : $this->secondPlayer->getName();

        return (
            new GameResultDTO(
                new PlayerResultDTO(
                        $this->firstPlayer->getName(),
                        $this->firstPlayer->getSelectedVehicle()->getName(),
                        $timeFirstPlayer * 60
                ),
                new PlayerResultDTO(
                        $this->secondPlayer->getName(),
                        $this->secondPlayer->getSelectedVehicle()->getName(),
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