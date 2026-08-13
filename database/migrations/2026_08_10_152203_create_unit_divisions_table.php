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
        Schema::create('unit_divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained(
                table: 'units', indexName: 'divisions_unit_id'
            );
            $table->foreignId('division_id')->constrained(
                table: 'divisions', indexName: 'units_division_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_divisions');
    }
};
