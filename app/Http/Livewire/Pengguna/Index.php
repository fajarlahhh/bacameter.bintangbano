<?php

namespace App\Http\Livewire\Pengguna;

use App\Models\Pengguna;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
  use WithPagination;

  public $tipe = 0, $cari, $key;

  protected $paginationTheme = 'bootstrap';

  public function updatingCari()
  {
    $this->resetPage();
  }

  public function setKey($key = null)
  {
    $this->key = $key;
  }

  public function updated()
  {
    $this->resetPage();
  }

  public function hapus()
  {
    Pengguna::findOrFail($this->key)->delete();
    $this->key = null;
    $this->resetPage();
    session()->flash('success', 'Berhasil menghapus data');
  }

  public function hapusPermanen()
  {
    Pengguna::findOrFail($this->key)->forceDelete();
    $this->key = null;
    $this->resetPage();
    session()->flash('success', 'Berhasil menghapus data');
  }

  public function restore()
  {
    Pengguna::withTrashed()->findOrFail($this->key)->restore();
    $this->key = null;
    $this->resetPage();
    session()->flash('success', 'Berhasil mengembalikan data');
  }

  public function render()
  {
    $this->emit('reinitialize');
    $data = Pengguna::where('nama', 'like', '%' . $this->cari . '%')->where('level', 2)->orderBy('id');

    switch ($this->tipe) {
      case '1':
        $data = $data->onlyTrashed();
        break;
      case '2':
        $data = $data->withTrashed();
        break;
    }
    $data = $data->paginate(10);
    return view('livewire.pengguna.index', [
      'i' => ($this->page - 1) * 10,
      'data' => $data,
    ]);
  }
}
