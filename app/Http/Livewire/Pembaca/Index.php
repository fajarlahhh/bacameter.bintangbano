<?php

namespace App\Http\Livewire\Pembaca;

use App\Models\Pembaca;
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
    Pembaca::withoutGlobalScopes()->find($this->key)->delete();
    $this->key = null;
    session()->flash('success', 'Berhasil menghapus data');
  }

  public function render()
  {
    $this->emit('reinitialize');
    $data = Pembaca::where('nama', 'like', '%' . $this->cari . '%');

    if (auth()->user()->level == 1) {
      $data = $data->withoutGlobalScopes();
    }

    return view('livewire.pembaca.index', [
      'data' => $data->orderBy('nama')->get(),
    ]);
  }
}
