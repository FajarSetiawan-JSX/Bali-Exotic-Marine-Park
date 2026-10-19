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
        Schema::create('booking_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained(
                table: 'bookings',
                indexName: 'bookings_booking_order_id'
            )->cascadeOnDelete();
            $table->foreignId('program_category_id')->constrained(
                table: 'program_categories',
                indexName: 'program_categories_booking_order_id'
            )->cascadeOnDelete();
            $table->enum('session', ['09:30', '10:00', '10:30' , '11:30' , '12:00', '13:00', '14:00', '15:00', '16:00']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_orders');
    }
};
