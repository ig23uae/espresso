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
        Schema::create('shift_replacements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('original_shift_id')->constrained('shifts'); // Исходная смена
            $table->foreignId('replacement_employee_id')->constrained('users'); // ID сотрудника-замены
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_replacements');
    }
};
