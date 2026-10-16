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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
