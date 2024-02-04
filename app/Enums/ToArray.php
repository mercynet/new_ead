<?php

namespace App\Enums;

use Exception;

trait ToArray
{
    public static function toArray(): array
    {
        return collect(self::cases())->map(fn($case) => $case->name)->toArray();
    }

    /**
     * @return array
     * @throws Exception
     */
    public static function labels(): array
    {
        $cases = [];
        foreach (self::cases() as $case) {
            $cases[$case->name] = $case->label();
        }
        return $cases;
    }

}
