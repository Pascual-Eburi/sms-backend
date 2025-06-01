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
        Schema::create('academic_level_stages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_level_id')
                ->nullable()
                ->constrained('academic_levels')
                ->nullOnDelete();
            $table->foreignId('academic_stage_id')
                ->nullable()
                ->constrained('academic_stages')
                ->nullOnDelete();
            $table->timestamps();

            $table->foreignId('center_id')
                ->nullable()
                ->constrained('centers')
                ->cascadeOnDelete()->cascadeOnUpdate();

            // 🔹 Clave única para evitar duplicados de pares (nivel + etapa)
            $table->unique(
                ['academic_level_id', 'academic_stage_id', 'center_id'],
                'academic_level_stage_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_level_stages');
    }
};
