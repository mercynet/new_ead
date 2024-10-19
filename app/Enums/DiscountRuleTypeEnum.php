<?php

namespace App\Enums;

use App\Traits\EnumCaseToArray;

/**
 *
 */
enum DiscountRuleTypeEnum
{
    use EnumCaseToArray;
    case percentage;
    case absolute;

    /**
     * @return string
     */
    public function label(): string
    {
        return self::getLabel($this);
    }

    /**
     * @param string $value
     * @return static
     */
    public static function getByValue(string $value): self
    {
        return match ($value) {
            'percentage' => self::percentage,
            default => self::absolute,
        };
    }

    /**
     * @param DiscountRuleTypeEnum $value
     * @return string
     */
    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::percentage => trans('discount_rules.enums.percentage'),
            self::absolute => trans('discount_rules.enums.absolute'),
        };
    }
}
