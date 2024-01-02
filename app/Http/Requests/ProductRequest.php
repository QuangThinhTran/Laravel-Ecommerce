<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => 'required | unique:products',
            'price' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'path' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'code.unique' => "The '{$this->input('code')}' has already been taken."
        ];
    }
}
