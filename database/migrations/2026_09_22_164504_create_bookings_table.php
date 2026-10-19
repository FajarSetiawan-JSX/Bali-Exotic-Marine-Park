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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'bookings_basic_information_id'
            )->cascadeOnDelete();
            $table->foreignId('methode_booking_id')->constrained(
                table: 'booking_methodes',
                indexName: 'bookings_methode_booking_id'
            );
            $table->string('name');
            $table->date('activity');
            $table->enum('payment', ['NETT', 'OTA', '50%', '100%']);
            $table->text('whatsapp')->nullable();
            $table->text('whatsapp_hash')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
