<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFoodDetail extends Model
{
    use HasFactory;
    protected $table = 'order_food_details';
    protected $fillable = ['order_id', 'food_id'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
