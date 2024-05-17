<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [Controller::class, 'index'])->name('client_index');

Route::prefix('panel')->group(function () {
    Route::get('/', [Controller::class, 'index'])->name('panel_index');
    // Остальные маршруты панели продавца...
});

// Группировка маршрутов с применением middleware
Route::middleware(['auth', 'role:user','verified'])->group(function () {
    Route::prefix('admin_panel')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin_index');

        // Используем resource route для напитков
        Route::resource('drinks', Admin\DrinkController::class);
        // Дополнительные маршруты для типов и размеров напитков можно объединить
        Route::resource('drink_types', Admin\DrinkTypeController::class);
        Route::resource('drink_sizes', Admin\DrinkSizeController::class);
    });
});

require __DIR__.'/auth.php';
