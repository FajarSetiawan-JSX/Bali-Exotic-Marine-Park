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
        Schema::create('permission_apis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_position_id')->constrained(
                table: 'division_positions',
                indexName: 'permission_apis_division_position_id'
            );
            $table->foreignId('api_id')->constrained(
                table: 'apis',
                indexName: 'permission_apis_api_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_apis');
    }
};
