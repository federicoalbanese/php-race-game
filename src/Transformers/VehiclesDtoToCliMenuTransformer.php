<?php
namespace Race\Transformers;

use Race\DTO\VehicleDTO;

class VehiclesDtoToCliMenuTransformer
{
    public static function transform(array $vehicleDTO)
    {
        return array_map(function (VehicleDTO $vdt){
            return $vdt->getName();
        },  $vehicleDTO);
    }
}