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
        Schema::create('templete_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('templete_id')->constrained(
                table: 'templetes',
                indexName: 'templete_times_templete_id'
            )->cascadeOnDelete();
            $table->foreignId('time_id')->constrained(
                table: 'times',
                indexName: 'templete_times_time_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('templete_times');
    }
};
