<?php

namespace App\Enums;

enum BannerLocal
{
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

    public static function toArray(): array
    {
        return collect(self::cases())->map(fn($case) => $case->name)->toArray();
    }
}
