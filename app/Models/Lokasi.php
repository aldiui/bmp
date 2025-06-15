<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Lokasi extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'lokasi';

    protected $fillable = [
        'kode',
        'nama',
        'latitude',
        'longitude',
        'jam_masuk_mulai',
        'jam_masuk_selesai',
        'jam_keluar_mulai',
        'jam_keluar_selesai',
        'radius',
        'alamat',
        'telepon',
    ];
}

