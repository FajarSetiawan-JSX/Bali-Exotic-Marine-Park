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
        Schema::create('answer_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patrol_area_section_question_id')->constrained(
                table: 'patrol_area_section_questions',
                indexName: 'answer_checklits_patrol_area_section_question_id'
            )->cascadeOnDelete()->nullable();
            $table->foreignId('patrol_question_id')->constrained(
                table: 'patrol_questions',
                indexName: 'answer_checklits_patrol_question_id'
            )->cascadeOnDelete()->nullable();
            $table->boolean('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_checklists');
    }
};
