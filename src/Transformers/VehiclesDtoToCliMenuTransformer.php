<?php
namespace Race\Transformers;

use Race\Entities\Vehicle;

class VehiclesDtoToCliMenuTransformer
{
    public static function transform(array $vehicles)
    {
        return array_map(function (Vehicle $vehicle){
            return $vehicle->getName();
        },  $vehicles);
    }
}