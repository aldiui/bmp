<?php

namespace App\Models;

use App\Models\Kategori;
use App\Models\Negara;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
