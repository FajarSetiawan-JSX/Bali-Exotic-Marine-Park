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
        Schema::create('visitor_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visitor_id')->constrained(
                table: 'visitors', indexName: 'visitor_suppliers_visitor_id'
            )->cascadeOnDelete();
            $table->foreignId('supplier_id')->constrained(
                table: 'suppliers', indexName: 'visitor_suppliers_visitor_supplier_id'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_suppliers');
    }
};
