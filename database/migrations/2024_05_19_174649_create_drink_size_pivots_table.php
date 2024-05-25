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
        Schema::create('drink_size_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drink_id')->constrained('drinks');
            $table->foreignId('size_id')->constrained('drink_sizes');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink_size_pivots');
    }
};
