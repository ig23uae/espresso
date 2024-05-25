<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderDrinkDetail extends Pivot
{
    protected $table = 'order_drink_details';
    protected $fillable = ['order_id', 'drink_pivot_id', 'created_at', 'updated_at'];
    protected $appends = ['quantity'];
    public function drinks()
    {
        return $this->belongsToMany(Drink::class, 'order_drink_details')
            ->using(OrderDrinkDetail::class)
            ->withPivot('size_id', 'created_at', 'updated_at')
            ->withTimestamps();
    }
    public function size()
    {
        return $this->belongsTo(DrinkSize::class, 'size_id');
    }

    public function drinkSizePivot()
    {
        return $this->belongsTo(DrinkSizePivot::class, 'drink_pivot_id');
    }

    public function getQuantityAttribute()
    {
        return self::where('order_id', $this->order_id)
            ->where('drink_pivot_id', $this->drink_pivot_id)
            ->count();
    }
}
