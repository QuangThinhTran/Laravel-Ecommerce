<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'username' => 'required | regex:/^[^\W_]+$/u | unique:users',//unique username and not char special
            'email' => 'required | email | unique:users', //unique email
            'password' => 'required | min:6',
            'password_confirm' => 'required | same:password'
        ];
    }
}
