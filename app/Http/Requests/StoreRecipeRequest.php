<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRecipeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.id' => 'required|exists:ingredients,id',
            'ingredients.*.amount' => 'required|numeric|min:0.1',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please provide a name for the recipe.',
            'description.required' => 'Please provide a description for the recipe.',
            'ingredients.required' => 'Please add at least one ingredient to the recipe.',
            'ingredients.*.id.required' => 'Ingredient ID is required.',
            'ingredients.*.id.exists' => 'Selected ingredient does not exist.',
            'ingredients.*.amount.required' => 'Ingredient amount is required.',
            'ingredients.*.amount.numeric' => 'Ingredient amount should be a number.',
            'ingredients.*.amount.min' => 'Ingredient amount should be greater than zero.',
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
