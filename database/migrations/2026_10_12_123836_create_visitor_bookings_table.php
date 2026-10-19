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
        Schema::create('visitor_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained(
                table: 'visitors',
                indexName: 'visitor_bookings_visitor_id'
            )->cascadeOnDelete();
            $table->foreignId('booking_id')->constrained(
                table: 'bookings',
                indexName: 'visitor_bookings_booking_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_bookings');
    }
};
