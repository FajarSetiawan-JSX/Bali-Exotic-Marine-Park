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
        Schema::create('logistics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained(
                table: 'suppliers',
                indexName: 'logistics_supplier_id'
            )->cascadeOnDelete();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'logistics_basic_information_id'
            )->cascadeOnDelete();
            $table->string('item');
            $table->decimal('price')->nullable();
            $table->integer('pcs');
            $table->string('remark', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logistics');
    }
};
