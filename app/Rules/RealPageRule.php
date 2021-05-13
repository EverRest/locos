<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class RealPageRule
 *
 * @package App\Rules
 */
class RealPageRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $value > 0 && $value < 100000;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The Page number shouldn\'t be equal 0.';
    }
}
