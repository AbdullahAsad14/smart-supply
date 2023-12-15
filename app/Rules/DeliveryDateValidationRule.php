<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DeliveryDateValidationRule implements Rule
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
        $deliveryDate = strtotime($value);
        $minDate = strtotime('+48 hours');

        return $deliveryDate >= $minDate;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Delivery date should be at least 48 hours from the current time.';
    }
}
