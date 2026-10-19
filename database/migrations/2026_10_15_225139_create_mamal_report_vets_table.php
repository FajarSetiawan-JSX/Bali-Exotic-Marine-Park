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
        Schema::create('mamal_report_vets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basic_information_id')->constrained(
                table: 'basic_information',
                indexName: 'mamal_report_vets_basic_information_id'
            )->cascadeOnDelete();
            $table->foreignId('program_id')->nullable()->constrained(
                table: 'programs',
                indexName: 'mamal_report_vets_recomend_program_id'
            )->cascadeOnDelete();
            $table->foreignId('mamals_reports_id')->constrained(
                table: 'mamals_reports',
                indexName: 'mamal_report_vets_mamals_reports_id'
            )->cascadeOnDelete();
            $table->enum('group', ['A', 'B']);
            $table->enum('health', ['FIT', 'FIT RINGAN', 'KURANG FIT']);
            $table->string('klinis');
            $table->enum('status', ['GO', 'NO GO']);
            $table->enum('social', ['STABLE', 'NOT STABLE']);
            $table->string('additional')->nullable();
            $table->string('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mamal_report_vets');
    }
};
