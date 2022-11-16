<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Periode extends Component
{
  public $dataPeriode;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($data)
  {
    $this->dataPeriode = $data;
    //
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.form.periode');
  }
}
