<?php

namespace App\Http\Livewire\Pembaca;

use App\Models\Pembaca;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

class Form extends Component
{
    public $nama, $kode, $kataSandi, $back, $key, $data;

    public function submit()
    {
        $this->validate([
            'nama' => 'required',
            'kataSandi' => 'required',
            'kode' => 'required',
        ]);

        if (!$this->key) {
            $this->data->uid = Str::random(5);
        }
        $this->data->nama = strtoupper($this->nama);
        $this->data->kata_sandi = Hash::make($this->kataSandi);
        $this->data->kode = $this->kode;
        $this->data->save();

        session()->flash('success', 'Berhasil menyimpan data');
        return redirect()->to($this->back);
    }

    public function mount()
    {
        $this->back = Str::contains(url()->previous(), ['tambah', 'edit']) ? '/pembaca' : url()->previous();
        if ($this->key) {
            $this->data = Pembaca::findOrFail($this->key);
            $this->nama = $this->data->nama;
            $this->kode = $this->data->kode;
        } else {
            $this->data = new Pembaca();
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
        return view('livewire.pembaca.form');
    }
}
