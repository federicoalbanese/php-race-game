<?php

use Race\Entities\Player;
use Race\RacingGame;
use Race\Repositories\VehicleRepository;
use Race\Transformers\VehiclesDtoToCliMenuTransformer;
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

    $choice = menu(VehiclesDtoToCliMenuTransformer::transform($vehicleList), null, 'Choose an vehicle');
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
$gameData = $game->play();