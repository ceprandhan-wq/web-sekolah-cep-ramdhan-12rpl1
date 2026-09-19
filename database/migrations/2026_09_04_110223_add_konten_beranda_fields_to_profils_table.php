<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->string('moto')->nullable()->after('nama_sekolah');
            $table->text('sejarah')->nullable()->after('misi');
            $table->string('foto_hero')->nullable()->after('logo');
            $table->string('foto_sambutan')->nullable()->after('foto_hero');
        });

        // ubah kolom `misi` dari text menjadi json
        Schema::table('profils', function (Blueprint $table) {
            $table->dropColumn('misi');
        });

        Schema::table('profils', function (Blueprint $table) {
            $table->json('misi')->nullable()->after('visi');
        });
    }

    public function down(): void
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->dropColumn(['moto', 'sejarah', 'foto_hero', 'foto_sambutan']);
            $table->dropColumn('misi');
        });

        Schema::table('profils', function (Blueprint $table) {
            $table->text('misi')->nullable();
        });
    }
};