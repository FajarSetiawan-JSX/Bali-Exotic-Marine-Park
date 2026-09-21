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
        Schema::create('patrol_area_section_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patrol_area_section_id')->constrained(
                table: 'patrol_area_sections',
                indexName: 'patrol_area_section_questions_patrol_area_section_id'
            )->cascadeOnDelete();
            $table->foreignId('section_question_id')->constrained(
                table: 'section_questions',
                indexName: 'patrol_area_section_questions_section_question_id'
            )->cascadeOnDelete();
            $table->boolean('answer')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patrol_area_section_questions');
    }
};
