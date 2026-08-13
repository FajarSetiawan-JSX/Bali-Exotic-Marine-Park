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
        Schema::create('templetes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_work_time_id')->constrained(
                table: 'division_work_times',
                indexName: 'templetes_division_work_time_id'
            );
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'templetes_user_id'
            )->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templetes');
    }
};
