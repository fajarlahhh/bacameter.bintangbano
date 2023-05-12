<?php

namespace App\Http\Livewire\Cabang;

use App\Models\Cabang;
use Livewire\Component;
use Illuminate\Support\Str;

class Form extends Component
{
    public $nama, $back, $key, $data;

    public function submit()
    {
        $this->validate([
            'nama' => 'required',
        ]);

        $this->data->nama = strtoupper($this->nama);
        $this->data->save();

        session()->flash('success', 'Berhasil menyimpan data');
        return redirect()->to($this->back);
    }

    public function mount()
    {
        $this->back = Str::contains(url()->previous(), ['tambah', 'edit']) ? '/cabang' : url()->previous();
        if ($this->key) {
            $this->data = Cabang::findOrFail($this->key);
            $this->nama = $this->data->nama;
        } else {
            $this->data = new Cabang();
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
        return view('livewire.cabang.form');
    }
}
