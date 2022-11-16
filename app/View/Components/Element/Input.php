<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Input extends Component
{
  public $type, $attribute, $label, $value, $class, $id, $placeholder;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($type, $attribute, $label = null, $value = null, $class = null, $id = null, $placeholder = null)
  {
    //
    $this->type = $type;
    $this->attribute = $attribute;
    $this->label = $label;
    $this->class = $class;
    $this->value = $value;
    $this->placeholder = $placeholder;
    $this->id = $id;
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render()
  {
    return view('components.element.input');
  }
}
