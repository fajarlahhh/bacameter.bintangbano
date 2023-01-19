<?php

namespace App\Http\Livewire\Targetpenagihan;

use App\Imports\PenagihanImport;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;

    public $file;

    public function submit()
    {
        $this->validate([
            'file' => 'required',
        ]);
        $extension = $this->file->getClientOriginalExtension();
        Storage::putFileAs('public', $this->file, 'penagihan.' . $extension);
        Excel::import(new PenagihanImport(auth()->id()), '/public/' . 'penagihan.' . $extension);
        Storage::delete('public/penagihan.' . $extension);
        session()->flash('success', 'Berhasil menyimpan data');
        return redirect('/targetpenagihan');
    }
    public function render()
    {
        return view('livewire.targetpenagihan.import');
    }
}
