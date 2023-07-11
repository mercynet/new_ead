<?php

namespace App\Enums;

enum BannerLocal
{
    use ToArray;
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
