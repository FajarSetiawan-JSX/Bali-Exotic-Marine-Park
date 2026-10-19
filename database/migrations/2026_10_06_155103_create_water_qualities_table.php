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
        Schema::create('water_qualities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'water_qualities_basic_information_id'
            )->cascadeOnDelete();
            $table->foreignId('pool_id')->constrained(
                table: 'pools',
                indexName: 'water_qualities_pool_id'
            );
            $table->time('time', precision: 0);
            $table->decimal('ci', 15, 2);
            $table->decimal('ph', 15, 2);
            $table->decimal('phMeter', 15, 2);
            $table->decimal('celcius', 15, 2);
            $table->decimal('sanalitas', 15, 2);
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
        Schema::dropIfExists('water_qualities');
    }
};
