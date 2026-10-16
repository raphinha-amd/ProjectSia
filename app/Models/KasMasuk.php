<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kas_masuks';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
