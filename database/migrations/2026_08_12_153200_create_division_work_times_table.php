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
        Schema::create('division_work_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained(
                table: 'divisions', indexName: 'division_work_times_division_id'
            );
            $table->foreignId('work_time_id')->constrained(
                table: 'work_times', indexName: 'division_work_times_work_time_id'
            );
            $table->boolean('work');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_work_times');
    }
};
