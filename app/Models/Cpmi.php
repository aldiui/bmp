<?php
namespace App\Models;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Lokasi;
use App\Models\Absensi;
use App\Models\LamaranKerja;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cpmi extends Authenticatable
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'cpmi';

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'cpmi_id');
    }

    public function lamaranKerja()
    {
        return $this->hasMany(LamaranKerja::class, 'cpmi_id');
    }
}
