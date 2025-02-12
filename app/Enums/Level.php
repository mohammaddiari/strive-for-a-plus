<?php

namespace App\Enums;

enum Level: string
{
    case PRIMARY = 'primary';
    case LOWER_SECONDARY = 'lower_secondary';
    case UPPER_SECONDARY = 'upper_secondary';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function valueOptions(): array
    {
        $keyValues = [];

        foreach (self::cases() as $key) {
            $keyValues[$key->value] = ucwords(str_replace('_', ' ', $key->value));
        }

        return $keyValues;
    }
}
