<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'status', 'total_price', 'cashier_id', 'customer_id'];
    protected $casts = [
        'status' => OrderStatus::class,
    ];
    protected static function booted(): void
    {
        static::creating(function ($order) {
            $order->order_number = self::getNextOrderNumber();
        });
    }

    protected static function getNextOrderNumber(): string
    {
        $lastOrder = self::latest('id')->first();
        $nextNumber = $lastOrder ? ((int) $lastOrder->order_number + 1) % 100 : 0;
        return str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'order_food_details')
            ->withTimestamps();
    }

    public function drinks()
    {
        return $this->belongsToMany(Drink::class, 'order_drink_details', 'order_id', 'drink_pivot_id')
            ->with(['sizes']);
    }

    public function drinkDetails()
    {
        return $this->hasMany(OrderDrinkDetail::class);
    }
}
