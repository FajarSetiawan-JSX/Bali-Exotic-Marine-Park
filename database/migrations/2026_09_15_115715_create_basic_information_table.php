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
        Schema::create('basic_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('date_id')->constrained(
                table: 'dates',
                indexName: 'basic_informations_date_id'
            )->cascadeOnDelete();
            $table->foreignId('division_id')->constrained(
                table: 'divisions',
                indexName: 'basic_informations_division_id'
            )->cascadeOnDelete();
            $table->foreignId('templete_id')->constrained(
                table: 'templetes',
                indexName: 'basic_informations_templete_id'
            )->cascadeOnDelete();
            $table->boolean('handover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('basic_information');
    }
};
