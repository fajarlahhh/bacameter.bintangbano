<?php

namespace App\View\Components\Element;

use Illuminate\View\Component;

class Textarea extends Component
{
  public $attribute, $label, $id, $value;
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($attribute, $label = null, $value = null, $id = null)
  {
    //
    $this->value = $value;
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
    return view('components.element.textarea');
  }
}
