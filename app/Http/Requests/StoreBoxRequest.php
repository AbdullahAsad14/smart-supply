<?php

namespace App\Http\Requests;

use App\Rules\DeliveryDateValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBoxRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'delivery_date' => ['required', 'date', new DeliveryDateValidationRule],
            'recipe_ids' => 'required|array|min:1|max:4',
            'recipe_ids.*' => 'required|integer|exists:recipes,id',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'delivery_date.required' => 'Delivery date is required.',
            'delivery_date.date' => 'Delivery date should be a valid future date by at least 2 days.',

            'recipe_ids.required' => 'Please include at least one recipe in the box.',
            'recipe_ids.array' => 'Recipes should be an array of IDs.',
            'recipe_ids.min' => 'Please include at least one recipe in the box.',
            'recipe_ids.max' => 'You can only select upto 4 recipes.',

            'recipe_ids.*.required' => 'Invalid recipe ID provided.',
            'recipe_ids.*.integer' => 'Recipe ID should be an integer.',
            'recipe_ids.*.exists' => 'Recipe with this ID does not exist.',
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
