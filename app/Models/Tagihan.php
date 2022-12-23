<?php

namespace App\Models;

use App\Traits\Pengguna;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory, Pengguna;

    protected $table = 'tagihan';

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'no_langganan', 'no_langganan')->select('jumlah', 'denda', 'periode', 'id');
    }
}
