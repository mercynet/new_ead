<?php

namespace App\Traits;

use App\Models\Order;

trait Document
{
    public static function generateDocumentNumber(string $type = 'order'): string
    {
        $setting = config("setting.{$type}.document_number");
        $prefix = $setting['number_prefix'];
        $next = $setting['number_next'];
        $digit = $setting['number_digit'];

        $lastOrderNumber = Order::select(['order_number'])->latest()->first();
        $orderNumber = !empty($lastOrderNumber) ? self::splitDocumentNumber($lastOrderNumber->order_number) . $next : $next;
        return $prefix . str_pad($orderNumber, $digit, '0', STR_PAD_LEFT);
    }

    public static function splitDocumentNumber(string $documentNumber, string $separator = '-'): int|string
    {
        $number = explode($separator, $documentNumber);
        return end($number);
    }
}
