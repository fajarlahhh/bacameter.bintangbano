<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Checkbox extends Component
{
  public $attribute, $value, $label;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($attribute, $label, $value = null)
  {
    //
    $this->attribute = $attribute;
    $this->value = $value;
    $this->label = $label;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.element.checkbox');
  }
}
