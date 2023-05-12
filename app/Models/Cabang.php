<?php

namespace App\Models;

use App\Traits\Pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cabang extends Model
{
    use HasFactory, Pengguna;

    protected $table = 'cabang';
}
