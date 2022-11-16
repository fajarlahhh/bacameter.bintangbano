<?php

namespace App\Http\Livewire\Pengguna;

use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
  public $uid, $kataSandi, $perusahaan, $nama, $back, $key, $data;

  public function submit()
  {
    if ($this->key) {
      $this->validate([
        'nama' => 'required',
        'perusahaan' => 'required',
      ]);
    } else {
      $this->validate([
        'uid' => 'required',
        'nama' => 'required',
        'perusahaan' => 'required',
        'kataSandi' => 'required',
      ]);
    }

    $this->data->kata_sandi = Hash::make($this->kataSandi);
    $this->data->nama = $this->nama;
    if (!$this->key) {
      $this->data->uid = $this->uid;
    }
    $this->data->perusahaan = $this->perusahaan;
    $this->data->level = 2;
    $this->data->save();

    session()->flash('success', 'Berhasil menyimpan data');
    return redirect()->to($this->back);
  }

  public function mount()
  {
    $this->back = Str::contains(url()->previous(), ['tambah', 'edit']) ? '/pengguna' : url()->previous();
    if ($this->key) {
      $this->data = Pengguna::findOrFail($this->key);
      $this->uid = $this->data->uid;
      $this->nama = $this->data->nama;
      $this->perusahaan = $this->data->perusahaan;
    } else {
      $this->data = new Pengguna();
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
    return view('livewire.pengguna.form');
  }
}
