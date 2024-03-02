<?php

use Race\Entities\Player;
use Race\RacingGame;
use Race\Repositories\VehicleRepository;
use Race\Transformers\Menu\VehiclesTransformer;
use function cli\line;
use function cli\menu;
use function cli\out;

require_once 'autoload.php';

$vehicleRepository = new VehicleRepository();
$vehicleList = $vehicleRepository->get();
$game = new RacingGame();

$playerId = 1;
$playersVehicle = [];
while ($playerId < 3) {
    out(sprintf("player %s choice vehicle from below list: ", $playerId));
    line();
    line();

    $choice = menu(VehiclesTransformer::transform($vehicleList), null, 'Choose an vehicle');
    line();

    if ($choice == 'quit') {
        break;
    }

    $player = new Player(sprintf('player %s', $playerId), $vehicleRepository->find($choice));
    $game->addPlayer($player);
    unset($vehicleList[$choice]);
    $playerId++;
    line();
}
$distance = 100;

$gameResult = $game->play($distance);


out( "Race Results:");
line();
out(sprintf("Player 1 - %s:", $gameResult->getPlayerOneResultDTO()->getName()));
line();
out(sprintf("   Vehicle: %s", $gameResult->getPlayerOneResultDTO()->getVehicleName()));
line();
out(sprintf("   Time: %s minutes", $gameResult->getPlayerOneResultDTO()->getTime()));
line();
out(sprintf("Player 2 - %s:",$gameResult->getPlayerSecondResultDTO()->getName()));
line();
out(sprintf("   Vehicle: %s", $gameResult->getPlayerSecondResultDTO()->getVehicleName()));
line();
out(sprintf("   Time: %s minutes", $gameResult->getPlayerSecondResultDTO()->getTime()));

line();
line();

out(sprintf('Winner: %s', $gameResult->getWinner()));