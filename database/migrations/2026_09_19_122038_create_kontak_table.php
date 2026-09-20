<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->text('alamat')->nullable();
            $table->string('telepon', 30)->nullable();
            $table->string('whatsapp', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->text('maps_embed')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontak');
    }
};