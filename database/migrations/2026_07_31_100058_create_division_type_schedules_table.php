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
        Schema::create('division_type_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained(
                table: 'divisions',
                indexName: 'types_division_id'
            )->cascadeOnDelete();
            $table->foreignId('type_schedule_id')->constrained(
                table: 'type_schedules',
                indexName: 'types_schedule_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_type_schedules');
    }
};
