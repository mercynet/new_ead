<?php

namespace App\Enums;

trait ToArray
{
    public static function toArray(): array
    {
        return collect(self::cases())->map(fn($case) => $case->name)->toArray();
    }
}
