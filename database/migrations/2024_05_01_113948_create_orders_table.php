<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 3); // Номер заказа, циклический от 000 до 099
            $table->enum('status', ['processing', 'ready', 'saved', 'done']); // Статус заказа
            $table->decimal('total_price'); // Общая цена заказа
            $table->foreignId('cashier_id')->nullable()->constrained('users'); // ID кассира (необязательно)
            $table->foreignId('customer_id')->nullable()->constrained('users'); // ID пользователя (необязательно)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
