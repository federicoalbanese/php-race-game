<?php
namespace Race\Transformers;

use Race\DTO\VehicleDTO;

class VehiclesDtoToCliMenuTransformer
{
    public static function transform(array $vehicleDTOs)
    {
        return array_map(function (VehicleDTO $vehicleDto){
            return $vehicleDto->getName();
        },  $vehicleDTOs);
    }
}