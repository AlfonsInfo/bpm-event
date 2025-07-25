<?php

namespace App\Enums;

enum EventType: string
{
    case ONLINE = 'ONLINE';
    case OFFLINE = 'OFFLINE';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}