<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email'          => ['required', 'string', 'email', 'max:50'],
            'last_login'     => ['nullable', 'date_format:Y-m-d H:i:s'],
            'remember_token' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => ':attribute is required.',
            'password.required' => ':attribute is required.',
            'password.min' => ':attribute is should be minimum 8 character.',
            'first_name.required' => ':attribute is required.',
            'last_name.required' => ':attribute is required.',
            'email.required' => ':attribute is required.',
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
