<?php

namespace App\Enums;

enum EventScope: string
{
    case INTERNAL = 'INTERNAL';
    case PRIVATE = 'PRIVATE';
    case PUBLIC = 'PUBLIC';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}