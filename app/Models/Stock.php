<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'quantity', 'expiry_date'];

    // Связь с браком
    public function defects()
    {
        return $this->hasMany(Defect::class);
    }

    // Метод для вычитания использованного количества продукта
    public function consume($amount): void
    {
        $this->quantity -= $amount;
        $this->save();
    }

    // Метод для добавления брака
    public function addDefect($employee_id, $quantity): void
    {
        $defect = new Defect([
            'employee_id' => $employee_id,
            'quantity' => $quantity
        ]);
        $this->defects()->save($defect);
        $this->consume($quantity); // Вычитаем бракованный продукт из общего количества
    }
}
