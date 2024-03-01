<?php

namespace Race\Enums;

enum Units: string
{
    case KTS = 'Kts';

    case KNOTS = 'knots';

    case KM_PER_HOUR = 'Km/h';

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
