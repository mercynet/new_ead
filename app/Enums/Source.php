<?php

namespace App\Enums;

enum Source
{
    use ToArray;
    case site;
    case mzrt;
    case platform;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::site => 'Site',
            self::mzrt => 'Mozart',
            default => 'Platform'
        };
    }

    public function label(): string
    {
        return self::getLabel($this);
    }
}
