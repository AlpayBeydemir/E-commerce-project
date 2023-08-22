<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}
