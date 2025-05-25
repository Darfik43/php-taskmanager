<?php

namespace App\Task\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RussianAlphabet implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[а-яА-ЯёЁ0-9\s\-.,!?"\']+$/u', $value)) {
            $fail('Поле :attribute может содержать только символы русского алфавита');
        }
    }
}
