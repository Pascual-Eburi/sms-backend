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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('dob');
            $table->string('phone');
            $table->string('address');
            $table->string('teacher_number')->unique();
            $table->string('document');
            $table->string('document_type');
            $table->date('seniority')->nullable();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });
    }*/

    /**
     * Reverse the migrations.
     */
/*    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }*/
};
