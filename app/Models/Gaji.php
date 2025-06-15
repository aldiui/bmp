<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Gaji extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'gaji';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->where('karyawan', true);
    }
}
