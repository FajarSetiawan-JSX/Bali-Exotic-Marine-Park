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
        Schema::create('arrives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'arrives_basic_information_id'
            )->cascadeOnDelete();
            $table->foreignId('purchase_order_id')->constrained(
                table: 'purchase_orders',
                indexName: 'arrives_purchase_order_id'
            )->cascadeOnDelete();
            $table->text('additional');
            $table->text('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrives');
    }
};
