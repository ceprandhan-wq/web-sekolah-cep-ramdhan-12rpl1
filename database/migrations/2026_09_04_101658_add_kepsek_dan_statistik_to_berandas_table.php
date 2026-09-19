<?php
// database/migrations/xxxx_xx_xx_add_kepsek_dan_statistik_to_berandas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berandas', function (Blueprint $table) {
            // Sambutan Kepala Sekolah
            $table->string('kepsek_nama')->nullable()->after('website');
            $table->string('kepsek_jabatan')->nullable()->default('Kepala Sekolah')->after('kepsek_nama');
            $table->string('kepsek_foto')->nullable()->after('kepsek_jabatan');
            $table->text('sambutan')->nullable()->after('kepsek_foto');

            // Statistik Sekolah
            $table->unsignedInteger('jumlah_siswa')->default(0)->after('sambutan');
            $table->unsignedInteger('jumlah_guru')->default(0)->after('jumlah_siswa');
        });
    }

    public function down(): void
    {
        Schema::table('berandas', function (Blueprint $table) {
            $table->dropColumn([
                'kepsek_nama', 'kepsek_jabatan', 'kepsek_foto', 'sambutan',
                'jumlah_siswa', 'jumlah_guru',
            ]);
        });
    }
};