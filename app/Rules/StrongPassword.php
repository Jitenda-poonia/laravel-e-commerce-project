<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StrongPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (
            !preg_match('/[A-Z]/', $value) || // कम से कम एक बड़ा अक्षर
            !preg_match('/[a-z]/', $value) || // कम से कम एक छोटा अक्षर
            !preg_match('/[0-9]/', $value) || // कम से कम एक संख्या
            !preg_match('/[\W]/', $value) || // कम से कम एक विशेष वर्ण
            strlen($value) < 8 // न्यूनतम लंबाई 8
        ) {
            $fail('The :attribute must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.');
        }
    }

}
