<?php

namespace App\Enums;

use App\Traits\EnumCaseToArray;

enum BannerLocal
{
    use EnumCaseToArray;
    case categories;
    case lesson;
    case account;
    case hero;
    case home_middle;
    case home_footer;

    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::categories => 'Categorias',
            self::lesson => 'Aulas',
            self::account => 'Minha Conta',
            self::hero => 'Banner principal',
            self::home_middle => 'Centro da homepage',
            default => 'Rodapé da homepage'
        };
    }
}
