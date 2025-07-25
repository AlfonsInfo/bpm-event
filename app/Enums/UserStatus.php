<?php

namespace App\Enums;

enum UserStatus: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Banned = 'Banned';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}