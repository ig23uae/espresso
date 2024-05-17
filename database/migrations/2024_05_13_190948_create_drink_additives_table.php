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
        Schema::create('drink_additives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_detail_id')->constrained('order_drink_details');
            $table->foreignId('additive_id')->constrained('additives');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drink_additives');
    }
};
