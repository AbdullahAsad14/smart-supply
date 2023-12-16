<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetRequiredIngredientsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'order_date' => 'nullable|date',
            'supplier' => 'nullable|string|max:255',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'order_date.date' => 'Order date should be a valid date.',

            'supplier.string' => 'Supplier must be a string.',
            'supplier.max' => 'Supplier name should not exceed :max characters.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors!',
            'data'      => $validator->errors()
        ], 422));
    }
}
