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
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('methode_id')->constrained(
                table: 'methodes',
                indexName: 'apis_methode_id'
            );
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('route');
            $table->string('url');
            $table->enum('scope', ['Super Admin', 'General', 'Specific']);
            $table->text('description', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apis');
    }
};
