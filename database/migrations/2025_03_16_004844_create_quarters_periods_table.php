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
        Schema::create('quarters_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_year_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('center_id')
                ->nullable()
                ->constrained('centers')
                ->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quarters_periods');
    }
};
