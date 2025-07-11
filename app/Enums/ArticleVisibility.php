<?php

namespace App\Enums;

enum ArticleVisibility: string
{
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
    
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}