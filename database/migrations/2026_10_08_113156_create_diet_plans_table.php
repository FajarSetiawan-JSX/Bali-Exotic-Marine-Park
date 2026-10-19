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
        Schema::create('diet_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'diet_plans_basic_information_id'
            )->cascadeOnDelete();
            $table->foreignId('mamal_id')->constrained(
                table: 'mamals',
                indexName: 'diet_plans_mamal_id'
            )->cascadeOnDelete();
            $table->decimal('gelatin', 5,2);
            $table->decimal('selar', 5,2);
            $table->decimal('layang', 5,2);
            $table->decimal('total', 5,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_plans');
    }
};
