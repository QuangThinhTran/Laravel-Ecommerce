<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'customer_name' => 'required',
            'customer_email' => 'required',
            'customer_id' => 'required',
            'merchant_name' => 'required',
            'merchant_email' => 'required',
            'merchant_id' => 'required',

            'quantity' => 'required',
            'total' => 'required',
            'active' => 'required',
            'status_id' => 'required',
            'cart_id' => 'required',
        ];
    }
}
