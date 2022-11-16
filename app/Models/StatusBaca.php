<?php

namespace App\Models;

use App\Models\Scopes\PenggunaScope;
use App\Traits\Pengguna;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBaca extends Model
{
  use HasFactory, Pengguna;

  protected $table = 'status_baca';

  protected static function boot()
  {
    parent::boot();
    static::addGlobalScope(new PenggunaScope);
  }
}
