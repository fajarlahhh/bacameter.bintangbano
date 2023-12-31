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

    public $status = 0, $pembaca, $tanggal1, $tanggal2, $cari, $hapus, $reset;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['tanggal1', 'tanggal2', 'pembaca', 'status', 'cari'];

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
        $this->tanggal1 = $this->tanggal1 ?: date('Y-m-d');
        $this->tanggal2 = $this->tanggal2 ?: date('Y-m-d');
    }

    public function export()
    {
        $this->emit('reinitialize');
        return Excel::download(new PenagihanExport($this->cari, $this->status, $this->pembaca, $this->tanggal1, $this->tanggal2), 'Data Penagihan ' . $this->tanggal1 . ' - ' . $this->tanggal2 . ' ' . ($this->status == 0 ? 'Belum Ditagih' : 'Tertagih ') . '.xlsx');
    }

    public function render()
    {
        $data = Tagihan::where(fn ($q) => $q->where('no_langganan', 'like', '%' . $this->cari . '%')->orWhere('nama', 'like', '%' . $this->cari . '%'))->select('cabang_id', 'tanggal_tagih', 'stand_ini', 'stand_lalu', 'no_langganan', 'golongan', 'status', 'pembaca_kode', 'nama', 'alamat', 'jumlah', 'periode', DB::raw('if( date(  NOW()) > DATE_ADD( STR_TO_DATE(concat( SUBSTR( periode, 1, 8 ), "20" ), "%Y-%m-%d"), INTERVAL 1 MONTH), 5000, 0 ) denda'), 'id')->when($this->status == 1, fn ($q) => $q->whereNotNull('tanggal_tagih')->whereBetween('tanggal_tagih', [$this->tanggal1 . ' 00:00:00', $this->tanggal2 . ' 23:59:59']))->when($this->status == 0, fn ($q) => $q->whereNull('tanggal_tagih'))->when($this->pembaca, fn ($q) => $q->where('cabang_id', $this->pembaca))->paginate(10);
        return view('livewire.targetpenagihan.index', [
            'no' => ($this->page - 1) * 10,
            'data' => $data,
        ]);
    }
}
