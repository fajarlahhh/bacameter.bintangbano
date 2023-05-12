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
            'status' => $row[3],
            'golongan' => $row[4],
            'periode' => $row[5] . '-01',
            'stand_lalu' => $row[6],
            'stand_ini' => $row[7],
            'jumlah' => $row[8],
            'pembaca_kode' => $row[9],
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
