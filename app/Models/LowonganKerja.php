<?php

namespace App\Models;

use App\Models\User;
use App\Models\Negara;
use App\Models\Kategori;
use App\Models\LamaranKerja;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LowonganKerja extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'lowongan_kerja';

    protected $guarded = [];

    protected $casts = [
        'gaji_awal' => 'decimal:2',
        'gaji_akhir' => 'decimal:2',
        'tampilkan_gaji' => 'boolean',
    ];

    public function negara()
    {
        return $this->belongsTo(Negara::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function lamaranKerja()
    {
        return $this->hasMany(LamaranKerja::class);
    }
}
