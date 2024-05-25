<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkSize extends Model
{
    protected $table = 'drink_sizes';
    protected $fillable = ['size_name', 'size', 'created_at', 'updated_at'];

}
