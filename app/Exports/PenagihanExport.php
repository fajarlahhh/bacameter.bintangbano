<?php

namespace App\Exports;

use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenagihanExport implements FromCollection, WithMapping, WithHeadings
{
    public $cari, $status, $pembaca, $tahun, $bulan;

    public function __construct($cari, $status, $pembaca, $tahun, $bulan)
    {
        $this->cari = $cari;
        $this->status = $status;
        $this->pembaca = $pembaca;
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return Tagihan::where(fn ($q) => $q->where('no_langganan', 'like', '%' . $this->cari . '%')->orWhere('nama', 'like', '%' . $this->cari . '%'))->select('cabang_id', 'golongan', 'status', 'tanggal_tagih', 'stand_ini', 'stand_lalu', 'no_langganan', 'pembaca_kode', 'nama', 'alamat', 'jumlah', 'periode', 'denda', 'id')->when($this->status == 1, fn ($q) => $q->whereNotNull('tanggal_tagih')->where('tanggal_tagih', 'like', $this->tahun . '-' . $this->bulan . '%'))->when($this->status == 0, fn ($q) => $q->whereNull('tanggal_tagih'))->when($this->pembaca, fn ($q) => $q->where('cabang_id', $this->pembaca))->get();
    }
    public function map($data): array
    {
        return [
            $data->no_langganan,
            $data->nama,
            $data->alamat,
            $data->status,
            $data->golongan,
            $data->periode,
            $data->stand_lalu,
            $data->stand_ini,
            $data->jumlah,
            $data->denda,
            $data->tanggal_tagih,
            $data->pembaca_kode,
        ];
    }

    public function headings(): array
    {
        return [
            [
                'NO. LANGFFGANAN',
                'NAMA',
                'ALAMAT',
                'STATUS',
                'GOLONGAN',
                'PERIODE',
                'STAND LALU',
                'STAND INI',
                'JUMLAH',
                'DENDA',
                'TGL. TAGIH',
                'PETUGAS',
            ]
        ];
    }
}
