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
        Schema::create('patrol_area_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patrol_area_id')->constrained(
                table: 'patrol_areas',
                indexName: 'patrol_area_sections_patrol_area_id'
            )->cascadeOnDelete();
            $table->foreignId('area_section_id')->constrained(
                table: 'patrols',
                indexName: 'patrol_area_sections_area_section_id'
            )->cascadeOnDelete();
            $table->boolean('check')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patrol_area_sections');
    }
};
