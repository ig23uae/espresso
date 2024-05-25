<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'type_id', 'image'];

    public function type()
    {
        return $this->belongsTo(DrinkType::class, 'type_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(DrinkSize::class, 'drink_size_pivots', 'drink_id', 'size_id')
            ->withPivot('price');
    }
}
