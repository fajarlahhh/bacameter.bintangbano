<?php

namespace App\Http\Livewire\Targetpenagihan;

use App\Models\Tagihan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination;

  public $status = 0, $pembaca, $cari;
  protected $paginationTheme = 'bootstrap';

  protected $queryString = ['pembaca', 'status', 'cari'];

  public function updated()
  {
    $this->resetPage();
  }

  public function render()
  {
    $data = Tagihan::where(fn($q) => $q->where('no_langganan', 'like', '%' . $this->cari . '%')->orWhere('nama', 'like', '%' . $this->cari . '%'))->when($this->status == 1, fn($q) => $q->whereNotNull('tanggal_tagih'))->when($this->status == 0, fn($q) => $q->whereNull('tanggal_tagih'))->when($this->pembaca, fn($q) => $q->where('pembaca_kode', $this->pembaca))->paginate(10);
    return view('livewire.targetpenagihan.index', [
      'no' => ($this->page - 1) * 10,
      'data' => $data,
    ]);
  }
}
