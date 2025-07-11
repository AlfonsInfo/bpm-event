<?php

namespace App\Enums;

enum ArticleStatus: string
{
    case DRAFT = 'DRAFT';
    case PUBLISHED = 'PUBLISHED';

    case ARCHIVED = 'ARCHIVED';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}