<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
/*    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('subject_id')
                ->nullable()
                ->constrained('subjects')
                ->nullOnDelete();
            $table->foreignId('course_id')
                ->nullable()
                ->constrained('courses')
                ->nullOnDelete();
            $table->foreignId('people_id')
                ->nullable()
                ->constrained('people')
                ->nullOnDelete();
            $table->foreignId('quarter_period_id')
                ->nullable()
                ->constrained('quarters_periods')
                ->nullOnDelete();
            $table->timestamps();
        });
    }*/

    /**
     * Reverse the migrations.
     */
/*    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }*/
};
