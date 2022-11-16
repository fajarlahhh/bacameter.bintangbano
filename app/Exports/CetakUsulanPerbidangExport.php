<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class CetakUsulanPerbidangExport implements FromView
{
  public $data;

  use Exportable;

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function view(): View
  {
    return view('livewire.cetak.usulan.perkode.data', [
      'data' => $this->data,
    ]);
  }
}
