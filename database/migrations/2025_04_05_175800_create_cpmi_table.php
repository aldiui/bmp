<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cpmi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('lokasi_id')->nullable();
            $table->uuid('kelas_id')->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('telepon')->nullable();
            $table->string('password');
            $table->text('alamat')->nullable();
            $table->enum('status', ['Pendaftaran', 'Aktif', 'Tidak Aktif', 'Sudah Terbang'])->default('Pendaftaran');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cpmi');
    }
};
