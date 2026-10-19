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
        Schema::create('diet_plan_executes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diet_plan_approve_id')->constrained(
                table: 'diet_plan_approves',
                indexName: 'diet_plan_executes_diet_plan_approve_id'
            )->cascadeOnDelete();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'diet_plan_executes_basic_information_id'
            )->cascadeOnDelete();
            $table->decimal('gelatin', 5, 2);
            $table->decimal('selar', 5,2);
            $table->decimal('layang', 5, 2);
            $table->decimal('total', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_plan_executes');
    }
};
