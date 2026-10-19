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
        Schema::create('mamals_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'mamals_reports_basic_information_id'
            )->cascadeOnDelete();
            $table->foreignId('mamal_id')->nullable()->constrained(
                table: 'mamals',
                indexName: 'mamals_reports_mamal_id'
            )->cascadeOnDelete();
            $table->decimal('diet', 5,2);
            $table->integer('breathe');
            $table->decimal('faces', 5,2);
            $table->decimal('floating', 5,2);
            $table->string('attentive');
            $table->string('skin');
            $table->string('eyes');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mamals_reports');
    }
};
