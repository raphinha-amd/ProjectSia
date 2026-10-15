<?php

namespace App\Models;

use App\Models\Akun;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasKeluar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kas_keluars';

    public function akunKas()
    {
        return $this->belongsTo(Akun::class, 'id_akun_kas');
    }

    public function akunLawan()
    {
        return $this->belongsTo(Akun::class, 'id_akun_lawan');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
