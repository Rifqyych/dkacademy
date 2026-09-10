<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('program');
            $table->string('level');
            $table->text('message')->nullable();
            $table->date('tanggal_daftar'); // Tambahan fitur otomatis
            $table->enum('status', ['baru', 'diproses', 'diterima'])->default('baru'); // Untuk admin
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};