<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Select extends Component
{
  public $attribute, $label, $id, $style;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($attribute, $label = null, $style = '', $id = null)
  {
    //
    $this->style = $style;
    $this->attribute = $attribute;
    $this->label = $label;
    $this->id = $id;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.element.select');
  }
}
