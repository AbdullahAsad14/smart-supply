<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueIdPerObjectRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $ids = array_column($value, 'id');

        return count($ids) === count(array_unique($ids));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Each id should be unique and appear only once.';
    }
}
