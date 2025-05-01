<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lokasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->time('jam_masuk_mulai');
            $table->time('jam_masuk_selesai');
            $table->time('jam_keluar_mulai');
            $table->time('jam_keluar_selesai');
            $table->integer('radius');
            $table->text('alamat')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi');
    }
};
