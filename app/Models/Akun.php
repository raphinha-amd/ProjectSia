<?php

namespace App\Models;

use App\Models\KasKeluar;
use App\Models\KasMasuk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'akuns';

    public function kasMasukKas()
    {
        return $this->hasMany(KasMasuk::class, 'id_akun_kas');
    }

    public function kasMasukLawan()
    {
        return $this->hasMany(KasMasuk::class, 'id_akun_lawan');
    }

    public function kasKeluarKas()
    {
        return $this->hasMany(KasKeluar::class, 'id_akun_kas');
    }

    public function kasKeluarLawan()
    {
        return $this->hasMany(KasKeluar::class, 'id_akun_lawan');
    }
}
