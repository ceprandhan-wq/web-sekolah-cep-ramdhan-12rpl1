<?php
// database/migrations/xxxx_xx_xx_create_kepala_sekolahs_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kepala_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan')->default('Kepala Sekolah');
            $table->string('foto')->nullable();
            $table->longText('sambutan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kepala_sekolahs');
    }
};