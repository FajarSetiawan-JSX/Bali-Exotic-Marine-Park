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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained(
                table: 'divisions',
                indexName: 'questions_division_id'
            );
            $table->text('question');
            $table->enum('type', ['Checklist', 'Text', 'Upload']);
            $table->enum('case', ['Normal', 'Incident']);
            $table->string('part')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
