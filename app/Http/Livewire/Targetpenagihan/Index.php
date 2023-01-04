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

    public $bulan, $tahun, $status = 0, $pembaca, $cari;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['bulan', 'tahun', 'pembaca', 'status', 'cari'];

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
        $data = Tagihan::where(fn($q) => $q->where('no_langganan', 'like', '%' . $this->cari . '%')->orWhere('nama', 'like', '%' . $this->cari . '%'))->select('no_langganan', 'nama', 'alamat', 'jumlah', 'periode', DB::raw('if(date(DATE_ADD(NOW(), INTERVAL 1 HOUR)) > concat(SUBSTR(periode, 1, 8), "25"), 5000, 0) denda'), 'id')->when($this->status == 1, fn($q) => $q->whereNotNull('tanggal_tagih')->where('periode', $this->tahun . '-' . $this->bulan . '-01'))->when($this->status == 0, fn($q) => $q->whereNull('tanggal_tagih'))->when($this->pembaca, fn($q) => $q->where('pembaca_kode', $this->pembaca))->paginate(10);
        return view('livewire.targetpenagihan.index', [
            'no' => ($this->page - 1) * 10,
            'data' => $data,
        ]);
    }
}
