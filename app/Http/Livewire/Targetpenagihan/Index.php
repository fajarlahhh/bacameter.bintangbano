<?php

namespace App\Http\Livewire\Targetpenagihan;

use App\Exports\PenagihanExport;
use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    public $bulan, $tahun, $status = 0, $pembaca, $cari, $hapus, $reset;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['bulan', 'tahun', 'pembaca', 'status', 'cari'];

    public function setHapus($hapus = null)
    {
        $this->hapus = $hapus;
    }

    public function setReset($reset = null)
    {
        $this->reset = $reset;
    }

    public function ulangi()
    {
        $data = Tagihan::findOrFail($this->reset);
        $data->tanggal_tagih = null;
        $data->save();
        $this->reset = null;
    }

    public function hapus()
    {
        Tagihan::whereId($this->hapus)->delete();
        $this->hapus = null;
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->bulan = $this->bulan ?: date('m');
        $this->tahun = $this->tahun ?: date('Y');
    }

    public function export()
    {
        $this->emit('reinitialize');
        return Excel::download(new PenagihanExport($this->cari, $this->status, $this->pembaca, $this->tahun, $this->bulan), 'Data Penagihan - ' . $this->tahun . $this->bulan . '.xlsx');
    }

    public function render()
    {
        $data = Tagihan::where(fn ($q) => $q->where('no_langganan', 'like', '%' . $this->cari . '%')->orWhere('nama', 'like', '%' . $this->cari . '%'))->select('cabang_id', 'tanggal_tagih', 'stand_ini', 'stand_lalu', 'no_langganan', 'golongan', 'status', 'pembaca_kode', 'nama', 'alamat', 'jumlah', 'periode', DB::raw('if( date(  NOW()) > DATE_ADD( STR_TO_DATE(concat( SUBSTR( periode, 1, 8 ), "25" ), "%Y-%m-%d"), INTERVAL 1 MONTH), 5000, 0 ) denda'), 'id')->when($this->status == 1, fn ($q) => $q->whereNotNull('tanggal_tagih')->where('tanggal_tagih', 'like', $this->tahun . '-' . $this->bulan . '%'))->when($this->status == 0, fn ($q) => $q->whereNull('tanggal_tagih'))->when($this->pembaca, fn ($q) => $q->where('cabang_id', $this->pembaca))->paginate(10);
        return view('livewire.targetpenagihan.index', [
            'no' => ($this->page - 1) * 10,
            'data' => $data,
        ]);
    }
}
