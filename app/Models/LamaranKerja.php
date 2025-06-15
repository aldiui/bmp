<?php
namespace App\Models;

use App\Models\Cpmi;
use App\Models\LowonganKerja;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LamaranKerja extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'lamaran_kerja';

    protected $guarded = [];

    public function cpmi()
    {
        return $this->belongsTo(Cpmi::class, 'cpmi_id');
    }

    public function lowonganKerja()
    {
        return $this->belongsTo(LowonganKerja::class, 'lowongan_kerja_id');
    }
}
