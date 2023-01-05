<?php

namespace App\Http\Livewire\Targetbaca;

use App\Exports\BacameterExport;
use App\Models\BacaMeter;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    public $bulan, $tahun, $status = 0, $statusBaca, $pembaca, $cari, $hapus, $reset;
    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['bulan', 'tahun', 'status', 'pembaca', 'cari', 'statusBaca'];

    public function mount()
    {
        $this->bulan = $this->bulan ?: date('m');
        $this->tahun = $this->tahun ?: date('Y');
    }

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
        $data = BacaMeter::findOrFail($this->reset);
        File::delete($data->foto);
        $data->status_baca = null;
        $data->stand_ini = null;
        $data->tanggal_baca = null;
        $data->foto = null;
        $data->save();
        $this->reset = null;
    }

    public function hapus()
    {
        BacaMeter::whereId($this->hapus)->delete();
        $this->hapus = null;
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function export()
    {
        $this->emit('reinitialize');
        return Excel::download(new BacameterExport($this->cari, $this->status, $this->statusBaca, $this->pembaca, $this->tahun, $this->bulan), 'Data Baca Meter - ' . $this->tahun . $this->bulan . '.xlsx');
    }

    public function render()
    {
        if ($this->status == 0) {
            $this->statusBaca = null;
        }
        $data = BacaMeter::where(fn($q) => $q->where('no_langganan', 'like', '%' . $this->cari . '%')->orWhere('nama', 'like', '%' . $this->cari . '%'))->when($this->status == 1, fn($q) => $q->whereNotNull('tanggal_baca'))->when($this->status == 0, fn($q) => $q->whereNull('tanggal_baca'))->when($this->statusBaca, fn($q) => $q->where('status_baca', $this->statusBaca))->when($this->pembaca, fn($q) => $q->where('pembaca_kode', $this->pembaca))->where('periode', $this->tahun . '-' . $this->bulan . '-01')->paginate(10);
        return view('livewire.targetbaca.index', [
            'no' => ($this->page - 1) * 10,
            'data' => $data,
        ]);
    }
}
