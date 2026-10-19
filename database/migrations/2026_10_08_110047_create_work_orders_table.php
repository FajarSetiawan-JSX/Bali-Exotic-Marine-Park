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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'work_orders_basic_information_id'
            )->cascadeOnDelete();
            $table->foreignId('spv_id')->nullable()->constrained(
                table: 'users',
                indexName: 'work_orders_spv_id'
            );
            $table->string('item');
            $table->enum('status', ['Ganti', 'Maintenance', 'Penambahan']);
            $table->enum('confirm', ['confirmed', 'reject', 'waiting'])->default('waiting');
            $table->text('remark')->nullable();
            $table->text('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
