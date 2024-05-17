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
        Schema::create('drinks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //Название напитка
            $table->text('description');// Описание напитка
            $table->foreignId('type_id')->constrained('drink_types');
            $table->foreignId('size_id')->constrained('drink_sizes');
            $table->string('image'); // Путь к изображению
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coffees');
    }
};
