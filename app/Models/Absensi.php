<?php
namespace App\Models;

use App\Models\Cpmi;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Absensi extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'absensi';

    protected $guarded = [];

    public function cpmi()
    {
        return $this->belongsTo(Cpmi::class, 'cpmi_id');
    } 
}
