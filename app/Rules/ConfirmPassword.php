<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ConfirmPassword implements ValidationRule
{
    /**
     * Password for confirmation
     *
     */
    public $password;

    public function __construct($password) {
        $this->password = $password;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->password !== $value) {
            $fail('Senhas diferentes. Por favor, informe senhas iguais.');
        }
    }
}
