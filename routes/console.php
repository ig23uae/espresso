<?php

use App\Models\Shift;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    // Получаем список доступных сотрудников
    $employees = User::where('is_available', true)->get();

    // Пример алгоритма для предложения смен на следующую неделю
    foreach ($employees as $employee) {
        for ($day = 1; $day <= 7; $day += 2) { // Расписание "два через два"
            $shift = new Shift([
                'employee_id' => $employee->id,
                'start_time' => now()->addDays($day)->setHour(9),
                'end_time' => now()->addDays($day)->setHour(17),
                'confirmed' => false
            ]);
            $shift->save();
        }
    }
})->weekly();
