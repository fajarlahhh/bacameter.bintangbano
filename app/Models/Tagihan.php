<?php

namespace App\Models;

use App\Traits\Pengguna;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tagihan extends Model
{
    use HasFactory, Pengguna;

    protected $table = 'tagihan';

    protected $fillable = [
        'no_langganan',
        'nama',
        'alamat',
        'periode',
        'stand_lalu',
        'stand_ini',
        'cabang_id',
        'tanggal_tagih',
        'jumlah',
        'denda',
        'longitude',
        'latitude',
        'pengguna_id',
        'created_at',
        'updated_at',
    ];

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'no_langganan', 'no_langganan')->select('golongan', 'status', 'stand_lalu', 'stand_ini', DB::raw('stand_ini-stand_lalu pakai'), 'no_langganan', 'jumlah', 'periode', DB::raw('if( date(  NOW()) > DATE_ADD( STR_TO_DATE(concat( SUBSTR( periode, 1, 8 ), "25" ), "%Y-%m-%d"), INTERVAL 1 MONTH), 5000, 0 ) denda'), 'id')->whereNull('tanggal_tagih')->orderBy('periode', 'desc');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
