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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_time_id')->constrained(
                table: 'work_times',
                indexName: 'times_work_time_id'
            );
            $table->string('name')->unique();
            $table->string('slug');
            $table->time('start');
            $table->time('end');
            $table->time('break_start');
            $table->time('break_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('times');
    }
};
