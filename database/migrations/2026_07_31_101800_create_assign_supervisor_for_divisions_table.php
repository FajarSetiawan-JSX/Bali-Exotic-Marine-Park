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
        Schema::create('assign_supervisor_for_divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained(
                table: 'divisions',
                indexName: 'handles_division_id'
            )->cascadeOnDelete();
            $table->foreignId('user_position_id')->constrained(
                table: 'user_positions',
                indexName: 'assigns_user_position_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_supervisor_for_divisions');
    }
};
