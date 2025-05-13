<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan_kerja', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('negara_id');
            $table->uuid('kategori_id');
            $table->string('nama');
            $table->string('slug');
            $table->text('persyaratan'); 
            $table->string('gambar')->nullable();
            $table->double('gaji_awal')->nullable();
            $table->double('gaji_akhir')->nullable();
            $table->boolean('tampilkan_gaji')->default(false);
            $table->enum('status', ['Draft', 'Publish', 'Arsip']);
            $table->enum('status_loker', ['Urgent', 'Normal', 'Full']);
            $table->enum('status_kuota', ['Kuota', 'Unlimited']);
            $table->integer('kuota')->nullable();
            $table->integer('usia_minimal')->nullable();
            $table->integer('usia_maksimal')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan_kerja');
    }
};
