<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductInventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'numeric'],
            'quantity' => ['required', 'int'],
            'size' => ['required', 'string' ,'max:255'],
            'color' => ['required', 'string' ,'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'product_id' => 'Product',
            'quantity' => 'Quantity of Product',
            'size' => 'Size of Product',
            'color' => 'Color of Product',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
