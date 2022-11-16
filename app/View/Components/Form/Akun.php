<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Akun extends Component
{
  public $dataAkun;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($data)
  {
    $this->dataAkun = $data;
    //
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.form.akun');
  }
}
