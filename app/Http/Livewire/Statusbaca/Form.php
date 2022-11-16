<?php

namespace App\Http\Livewire\Statusbaca;

use App\Models\StatusBaca;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
  public $keterangan, $inputAngka, $back, $key, $data;

  public function submit()
  {
    $this->validate([
      'keterangan' => 'required',
      'inputAngka' => 'required',
    ]);

    $this->data->keterangan = strtoupper($this->keterangan);
    $this->data->input_angka = $this->inputAngka;
    $this->data->save();

    session()->flash('success', 'Berhasil menyimpan data');
    return redirect()->to($this->back);
  }

  public function mount()
  {
    $this->back = Str::contains(url()->previous(), ['tambah', 'edit']) ? '/statusbaca' : url()->previous();
    if ($this->key) {
      $this->data = StatusBaca::findOrFail($this->key);
      $this->keterangan = $this->data->keterangan;
      $this->inputAngka = $this->data->input_angka;
    } else {
      $this->data = new StatusBaca();
    }
  }

  public function batal()
  {
    return redirect()->to($this->back);
  }

  public function boot()
  {
    $this->emit('reinitialize');
  }

  public function render()
  {
    return view('livewire.statusbaca.form');
  }
}
