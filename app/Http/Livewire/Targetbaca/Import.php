<?php

namespace App\Http\Livewire\Targetbaca;

use App\Imports\BacameterImport;
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
    Storage::putFileAs('public', $this->file, 'bacameter.' . $extension);
    Excel::import(new BacameterImport(auth()->id()), '/public/' . 'bacameter.' . $extension);
    Storage::delete('public/bacameter.' . $extension);
    session()->flash('success', 'Berhasil menyimpan data');
    return redirect('/import');
  }

  public function render()
  {
    return view('livewire.targetbaca.import');
  }
}
