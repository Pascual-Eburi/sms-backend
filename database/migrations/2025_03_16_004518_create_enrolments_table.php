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
        Schema::create('enrolments', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('price');
            $table->foreignId('course_id');
            $table->foreignId('student_id');
            $table->foreignId('academic_year_id');
            $table->timestamps();
        });
    }*/

    /**
     * Reverse the migrations.
     */
 /*   public function down(): void
    {
        Schema::dropIfExists('enrolments');
    }*/
};
