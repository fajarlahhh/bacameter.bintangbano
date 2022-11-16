<?php

namespace App\Http\Livewire\Statusbaca;

use App\Models\StatusBaca;
use Livewire\Component;

class Index extends Component
{
  public $cari, $key;

  public function setKey($key = null)
  {
    $this->key = $key;
  }

  public function hapus()
  {
    StatusBaca::withoutGlobalScopes()->find($this->key)->delete();
    $this->key = null;
    session()->flash('success', 'Berhasil menghapus data');
  }

  public function render()
  {
    $this->emit('reinitialize');
    $data = StatusBaca::where('keterangan', 'like', '%' . $this->cari . '%');

    if (auth()->user()->level == 1) {
      $data = $data->withoutGlobalScopes();
    }

    return view('livewire.statusbaca.index', [
      'data' => $data->orderBy('keterangan')->get(),
    ]);
  }
}
