<?php
namespace Race\Transformers\Menu;

use Race\Entities\Vehicle;

class VehiclesTransformer
{
    public static function transform(array $vehicles)
    {
        return array_map(function (Vehicle $vehicle){
            return $vehicle->getName();
        },  $vehicles);
    }
}