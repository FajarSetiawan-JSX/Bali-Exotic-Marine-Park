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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'visitors_basic_information_id'
            )->cascadeOnDelete();
            $table->enum('category', ['supplier', 'vendor', 'guest', 'guide', 'personal']);
            $table->string('name');
            $table->integer('count')->nullable();
            $table->string('information')->nullable();
            $table->time('time', 0);
            $table->text('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
