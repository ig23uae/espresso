<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkSizePivot extends Model
{
    use HasFactory;
    protected $table = 'drink_size_pivots';
    protected $fillable = ['drink_id', 'size_id', 'price', 'created_at', 'updated_at'];

    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }

    public function size()
    {
        return $this->belongsTo(DrinkSize::class, 'size_id');
    }
}
