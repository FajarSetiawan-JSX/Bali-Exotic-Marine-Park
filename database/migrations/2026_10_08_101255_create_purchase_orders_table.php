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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'purchase_orders_basic_information_id'
            )->cascadeOnDelete();
            $table->foreignId('spv_id')->nullable()->constrained(
                table: 'users',
                indexName: 'purchase_orders_spv_id'
            );
            $table->string('supplier');
            $table->string('item');
            $table->decimal('nominal', 15, 0);
            $table->text('rekening');
            $table->enum('category', ['Operational', 'Project', 'Loss and Break']);
            $table->enum('status',['Normal', 'Urgent', 'Incidental']);
            $table->integer('duration');
            $table->text('remark')->nullable();
            $table->enum('confirm', ['confirmed', 'reject', 'waiting'])->default('waiting');
            $table->date('confirm_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
