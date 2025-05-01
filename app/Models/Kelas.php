<?php
namespace App\Models;

use App\Models\JadwalPelajaran;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Kelas extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'kelas';

    protected $guarded = [];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function jadwalPelajarans()
    {
        return $this->hasMany(JadwalPelajaran::class, 'kelas_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->check() ? auth()->user()->id : null;
            $model->updated_by = auth()->check() ? auth()->user()->id : null;
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->check() ? auth()->user()->id : null;
        });

        static::deleting(function ($model) {
            $model->deleted_by = auth()->check() ? auth()->user()->id : null;
        });
    }
}
