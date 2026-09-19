<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ekstrakurikuler', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembina')
                ->nullable()
                ->constrained('guru')
                ->nullOnDelete();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('jadwal')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikuler');
    }
};