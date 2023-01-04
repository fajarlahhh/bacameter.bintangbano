<?php

namespace App\Models;

use App\Traits\Pengguna;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusBaca extends Model
{
    use HasFactory, Pengguna;

    protected $table = 'status_baca';

}
