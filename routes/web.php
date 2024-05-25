<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DrinkController;
use App\Http\Controllers\Panel\BaristaController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Client\ClientController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//главная
Route::get('/', [ClientController::class, 'index'])->name('client_index');
//Меню
Route::get('/menu/{type}', [ClientController::class, 'menu'])->name('client_menu');
Route::post('/cart/update', [ClientController::class, 'cartUpdate']);
//Корзина
Route::get('/cart/{user_id}', [ClientController::class, 'cart'])->name('cart');
//Кофейни рядом
Route::get('/near', [ClientController::class, 'near'])->name('near');
// Оплата
Route::post('/payments/callback', [PaymentController::class, 'callback'])->name('payment.callback');
Route::get('/payments/create/{order_id}', [PaymentController::class, 'create'])->name('payment.create');
//Заказы
Route::get('/orders', [ClientController::class, 'orders'])->name('orders');
Route::get('/orders/{order_id}', [ClientController::class, 'order'])->name('order');
//Бариста
Route::get('/barista', [BaristaController::class, 'index'])->name('barista.index');
Route::post('/barista/ready/{order_id}', [BaristaController::class, 'ready']);
Route::get('/barista/get-order-details/{orderId}', [BaristaController::class, 'getOrderDetails']);

//todo
// Пересмотреть что и как приходит во время оплаты


// 3) Тестим разные товары и оплату
// 3.1) обновляем статус заказа, вешаем webhook на заказ
// 6) Делам интерфейс баристы где ему будут приходить заказы
// 8) Дописываем crud

// Логику учета ассортимента не делаем такой жесткой а просто смотрим сколько было сделано чашек кофе
// и показываем суммарно сколько за неделю было потрачено кофе, а уведомление об окончании надо пересмотреть


Route::prefix('worker_panel')->group(function () {
    Route::get('/', [PanelController::class, 'index'])->name('panel_index');
    Route::get('/fetch_menu', [PanelController::class, 'index'])->name('panel_index');
    Route::get('/drinks/{typeName}/{typeId}', [PanelController::class, 'getDrinksByType']);
    Route::get('/drink_sizes/{drinkId}/sizes', [PanelController::class, 'getSizes']);
    Route::get('/find_client', [PanelController::class, 'findClient']);
    Route::post('/submit-order', [PanelController::class, 'submitOrder']);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin_panel')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin_index');

        // Используем resource route для напитков
        Route::resource('drinks', DrinkController::class);
        Route::resource('drink_types', Admin\DrinkTypeController::class);
        Route::resource('drink_sizes', Admin\DrinkSizeController::class);
        Route::resource('drink_adds', Admin\AdditiveController::class);
        // Используем resource route для еды
        Route::resource('food', Admin\FoodController::class);
        Route::resource('food_type', Admin\FoodTypeController::class);
    });
});

require __DIR__.'/auth.php';
