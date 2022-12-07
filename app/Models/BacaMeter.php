<?php

namespace App\Models;

use App\Models\Scopes\PenggunaScope;
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

  protected static function boot()
  {
    parent::boot();
    static::addGlobalScope(new PenggunaScope);
  }
}
