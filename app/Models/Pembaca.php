<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembaca extends Model
{
    use HasFactory;

    protected $table = 'pembaca';

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
