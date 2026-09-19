<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ekstrakurikuler', function (Blueprint $table) {
            $table->string('lokasi')->nullable()->after('jadwal');
            $table->string('logo')->nullable()->after('foto');
            $table->json('kegiatan_rutin')->nullable()->after('deskripsi');
            $table->json('dokumentasi')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('ekstrakurikuler', function (Blueprint $table) {
            $table->dropColumn(['lokasi', 'logo', 'kegiatan_rutin', 'dokumentasi']);
        });
    }
};