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
        Schema::create('diet_plan_approves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diet_plan_id')->constrained(
                table: 'diet_plans',
                indexName: 'diet_plan_approves_diet_plan_id'
            )->cascadeOnDelete();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'diet_plan_approves_basic_information_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diet_plan_approves');
    }
};
