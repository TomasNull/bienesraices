<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneFormat implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        if (! $value) {
            return true;
        }

        $length = strlen($value);

        $success = true;

        if ($length < 9 || $length > 13) {
            $success = false;
        }

        return $success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('La longitud del campo :attribute es inválida.');
    }
}
