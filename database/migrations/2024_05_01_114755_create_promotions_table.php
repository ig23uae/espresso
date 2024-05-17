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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название акции
            $table->text('description');// Описание акции
            $table->string('code')->unique();// Идентификатор акции
            $table->dateTime('start');// Дата начала акции
            $table->dateTime('end');// Дата окончания акции
            $table->boolean('active');// Состояние акции
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
