<?php

use Race\DTO\PlayerVehicleDTO;
use Race\RaceGame;
use Race\Repositories\VehicleRepository;
use Race\Transformers\VehiclesDtoToCliMenuTransformer;
use function cli\line;
use function cli\menu;
use function cli\out;

require_once 'autoload.php';

$vehicleList = (new VehicleRepository())->get();
$game = new RaceGame();

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

    $game->addPlayerVehicle(PlayerVehicleDTO::fromArray(['vehicle' => $vehicleList[$choice],'player_id' => $playerId]));
    unset($vehicleList[$choice]);
    $playerId++;
    line();
}