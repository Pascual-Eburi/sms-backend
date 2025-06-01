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
        # 1º, 2º, 3º, 4º, 5º, 6º
        Schema::create('academic_stages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('center_id')
                ->nullable()
                ->constrained('centers')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_stages');
    }
};
