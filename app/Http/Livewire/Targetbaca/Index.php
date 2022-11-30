<?php

namespace App\Http\Livewire\Targetbaca;

use App\Models\BacaMeter;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination;

  public $bulan, $tahun, $status = 0, $statusBaca, $pembaca, $cari;
  protected $paginationTheme = 'bootstrap';

  protected $queryString = ['bulan', 'tahun', 'status', 'pembaca', 'cari'];

  public function mount()
  {
    $this->bulan = $this->bulan ?: date('m');
    $this->tahun = $this->tahun ?: date('Y');
  }

  public function updated()
  {
    $this->resetPage();
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
