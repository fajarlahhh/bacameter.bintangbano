<?php

namespace App\Http\Livewire\Cabang;

use App\Models\Cabang;
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
        Cabang::withoutGlobalScopes()->find($this->key)->delete();
        $this->key = null;
        session()->flash('success', 'Berhasil menghapus data');
    }

    public function render()
    {
        $this->emit('reinitialize');
        $data = Cabang::where('nama', 'like', '%' . $this->cari . '%');

        if (auth()->user()->level == 1) {
            $data = $data->withoutGlobalScopes();
        }

        return view('livewire.cabang.index', [
            'data' => $data->orderBy('nama')->get(),
        ]);
    }
}
