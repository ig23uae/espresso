<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'start_time', 'end_time', 'confirmed'];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function replacement()
    {
        return $this->hasOne(ShiftReplacement::class, 'original_shift_id');
    }
}
