<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BalanceRule implements Rule
{
  private $kredit;
  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct($kredit)
  {
    $this->kredit = $kredit;
    //
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    return $value == $this->kredit;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return 'Unbalanced debit and credit amounts';
  }
}
