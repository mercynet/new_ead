<?php

namespace App\Enums;

/**
 *
 */
enum OrderStatusEnum: string
{
    case PENDING = 'pending';
    case CANCELED = 'canceled';
    case REFUNDED = 'refunded';
    case COMPLETED = 'completed';

    /**
     * @return string
     */
    public function label(): string
    {
        return self::getLabel($this);
    }

    public static function getByStatusId(int $statusId): self
    {
        return match ($statusId) {
            3 => self::CANCELED,
            4 => self::REFUNDED,
            2 => self::COMPLETED,
            default => self::PENDING,
        };
    }

    public static function getByValue(string $value): self
    {
        return match ($value) {
            'canceled' => self::CANCELED,
            'refunded' => self::REFUNDED,
            'completed' => self::COMPLETED,
            default => self::PENDING,
        };
    }

    /**
     * @param OrderStatusEnum $value
     * @return string
     */
    public static function getLabel(self $value): string
    {
        return match ($value) {
            self::PENDING => 'Pendente',
            self::CANCELED => 'Cancelada',
            self::REFUNDED => 'Devolvida',
            self::COMPLETED => 'Paga',
        };
    }

    /**
     * @param OrderStatusEnum $status
     * @return int
     */
    public static function status(self $status): int
    {
        return match ($status) {
            self::COMPLETED => 2,
            self::CANCELED => 3,
            self::REFUNDED => 4,
            default => 1,
        };
    }
}
