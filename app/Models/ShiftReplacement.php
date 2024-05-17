<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftReplacement extends Model
{
    use HasFactory;

    protected $fillable = ['original_shift_id', 'replacement_employee_id'];

    public function originalShift()
    {
        return $this->belongsTo(Shift::class, 'original_shift_id');
    }

    public function replacementEmployee()
    {
        return $this->belongsTo(User::class, 'replacement_employee_id');
    }
}
