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
        Schema::create('section_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained(
                table: 'questions', indexName: 'section_questions_question_id'
            )->cascadeOnDelete();
            $table->foreignId('section_id')->constrained(
                table: 'sections', indexName: 'section_questions_section_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_questions');
    }
};
