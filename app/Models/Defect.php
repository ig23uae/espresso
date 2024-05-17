<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defect extends Model
{
    use HasFactory;

    protected $fillable = ['stock_id', 'employee_id', 'quantity'];

    // Связь с запасами
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    // Связь с сотрудником
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
