<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
        if ($this->is('post', 'api/User/Login')){
            return [
                'email'    => ['required', 'string', 'email'],
                'password' => ['required', 'string', 'min:8'],
            ];
        }

        return [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'       => ['required', 'string', 'min:8'],
            'gender'         => ['required', 'string'],
            'phone'          => ['required', 'string', 'max:20'],
            'last_login'     => ['nullable', 'date_format:Y-m-d H:i:s'],
            'remember_token' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'User Name',
            'email' => 'Email',
            'password' => 'Password',
            'gender' => 'Gender',
            'phone' => 'Phone'
        ];
    }

    public function messages(): array
    {
        return [
          'name.required' => ':attribute is required.',
          'email.required' => ':attribute is required.',
          'password.required' => ':attribute is required.',
          'password.min' => ':attribute is should be minimum 8 character.',
          'gender.required' => ':attribute is required.',
          'phone.required' => ':attribute is required.',
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
