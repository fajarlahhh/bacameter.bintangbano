<?php

namespace App\Imports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PenagihanImport implements ToModel, WithStartRow
{
    public $pengguna;

    public function __construct($pengguna)
    {
        $this->pengguna = $pengguna;
    }

    public function model(array $row)
    {
        return new Tagihan([
            'pengguna_id' => $this->pengguna,
            'no_langganan' => $row[0],
            'nama' => $row[1],
            'alamat' => $row[2],
            'periode' => $row[3] . '-01',
            'stand_lalu' => $row[4],
            'stand_ini' => $row[5],
            'jumlah' => $row[6],
            'pembaca_kode' => $row[7],
        ]);
    }
    public function uniqueBy()
    {
        return ['no_langganan', 'periode'];
    }
    public function upsertColumns()
    {
        return ['no_langganan', 'periode'];
    }

    public function startRow(): int
    {
        return 2;
    }
}
