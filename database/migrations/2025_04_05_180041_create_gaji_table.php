<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gaji', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->integer('tahun');
            $table->integer('bulan');
            $table->double('gaji_pokok')->nullable();
            $table->double('tunjangan')->nullable();
            $table->double('bonus')->nullable();
            $table->double('tunjangan_pajak')->nullable();
            $table->double('bpjs_jht')->nullable();
            $table->double('bpjs_kesehatan')->nullable();
            $table->double('pph_21')->nullable();
            $table->double('pinjaman')->nullable();
            $table->double('gaji_kotor')->nullable();
            $table->double('potongan')->nullable();
            $table->double('gaji_bersih')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
