<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'status', 'total_price', 'cashier_id', 'customer_id'];

    protected static function booted(): void
    {
        static::saving(function ($order) {
            $order->order_number = self::getNextOrderNumber();
        });
    }

    protected static function getNextOrderNumber(): string
    {
        $lastOrder = self::latest('id')->first();
        $nextNumber = $lastOrder ? ((int) $lastOrder->order_number + 1) % 100 : 0;
        return str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }
}
