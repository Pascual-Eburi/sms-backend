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
        Schema::create('people_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name')->unique();
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('people_types')
                ->nullOnDelete();

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
        Schema::dropIfExists('people_types');
    }
};
