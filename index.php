<?php

use Race\Repositories\VehicleRepository;
use Race\Transformers\VehiclesDtoToCliMenuTransformer;
use function cli\line;
use function cli\menu;
use function cli\out;

require_once 'autoload.php';

$vehicleList = (new VehicleRepository())->get();


while (true) {
    out('player one choice vehicle from below list: ');
    line();
    line();

    $choice = menu(VehiclesDtoToCliMenuTransformer::transform($vehicleList), null, 'Choose an vehicle');
    line();

    if ($choice == 'quit') {
        break;
    }

    include "{$choice}.php";
    line();
}