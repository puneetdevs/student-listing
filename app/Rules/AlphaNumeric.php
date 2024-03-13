<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaNumeric implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value contains only alphanumeric characters and underscores
        return preg_match('/^[A-Za-z0-9_.]+$/', $value);
    }

    public function message()
    {
        // Custom error message for when the validation fails
        return 'The :attribute must contain only alphanumeric characters and underscores.';
    }
}
