<?php

namespace App\Http\Livewire\Tagihan;

use App\Models\Tagihan;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination;

  public $status = 0, $pembaca, $cari;
  protected $paginationTheme = 'bootstrap';

  public function updated()
  {
    $this->resetPage();
  }

  public function render()
  {
    $data = Tagihan::where(fn($q) => $q->where('no_langganan', 'like', '%' . $this->cari . '%')->orWhere('nama', 'like', '%' . $this->cari . '%'))->when($this->status == 1, fn($q) => $q->whereNotNull('tanggal_tagih'))->when($this->status == 0, fn($q) => $q->whereNull('tanggal_tagih'))->when($this->pembaca, fn($q) => $q->where('pembaca_kode', $this->pembaca))->paginate(10);
    return view('livewire.tagihan.index', [
      'no' => ($this->page - 1) * 10,
      'data' => $data,
    ]);
  }
}
