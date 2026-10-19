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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('nik');
            $table->string('nik_hash', 64)->unique();
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->default(TRUE);
            $table->text('phone');
            $table->string('phone_hash', 64)->unique();
            $table->text('emergency');
            $table->string('emergency_hash', 64)->unique();
            $table->string('gender')->nullable();
            $table->string('born_at')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('religion', ['Islam', 'Kristen', 'Katholik', 'Hindu', 'Buddha', 'Konghucu', 'Other'])->nullable();
            $table->enum('status_tk', ['TK/O', 'K/0', 'K/1', 'K/2'])->nullable();
            $table->string('rekening')->nullable()->unique();
            $table->string('rekening_hash', 64)->nullable()->unique();
            $table->string('bpjs_kes')->nullable()->unique();
            $table->string('bpjs_kes_hash', 64)->nullable()->unique();
            $table->string('bpjs_tk')->nullable()->unique();
            $table->string('bpjs_tk_hash', 64)->nullable()->unique();
            $table->text('address')->nullable();
            $table->text('profile')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
