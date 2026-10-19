<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\PseudoTypes\True_;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patrol_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patrol_id')->constrained(
                table: 'patrols', indexName: 'patrol_questions_patrol_id'
            );
            $table->foreignId('question_id')->constrained(
                table: 'questions', indexName: 'patrol_questions_question_id'
            );
            $table->boolean('answered')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patrol_questions');
    }
};
