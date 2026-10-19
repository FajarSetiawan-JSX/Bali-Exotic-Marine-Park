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
        Schema::create('pool_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'pool_plans_basic_information_id'
            )->cascadeOnDelete();
            $table->decimal('chlorine', 15, 2);
            $table->decimal('sodaAsh', 15, 2);
            $table->decimal('hcl', 15, 2);
            $table->string('additional', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pool_plans');
    }
};
