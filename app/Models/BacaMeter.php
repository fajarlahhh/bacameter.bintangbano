<?php

namespace App\Models;

use App\Traits\Pengguna;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BacaMeter extends Model
{
    use HasFactory, Pengguna;

    protected $table = 'baca_meter';

    protected $fillable = [
        'pengguna_id', 'no_langganan', 'nama', 'alamat', 'periode', 'pembaca_kode',
    ];

    public function pembaca()
    {
        return $this->belongsTo(Pembaca::class, 'pembaca_kode', 'kode');
    }
}
