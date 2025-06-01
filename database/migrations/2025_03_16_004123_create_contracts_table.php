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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('sign_date');
            $table->float('salary');
            $table->float('hours');
            $table->integer('holidays');
            $table->string('employment_type');
            $table->string('employee_sign')->nullable();
            $table->string('employee_name');
            $table->string('employee_number');
            $table->string('director_signature')->nullable();
            $table->foreignId('teacher_id')
                ->nullable()
                ->constrained('teachers')
                ->nullOnDelete();
            $table->timestamps();
        });
    }*/

    /**
     * Reverse the migrations.
     */
/*    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }*/
};
