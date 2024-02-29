<?php

namespace Race\Enums;

enum Units: string
{
    case Kts = 'kts';

    case Km = 'km/h';

    /**
     * @param  string  $string
     * @return Units
     */
    public static function fromString(string $string): Units
    {
        return match ($string) {
            'Kts', 'knots' => self::Kts,
            'Km/h' => self::Km,
        };
    }
}
