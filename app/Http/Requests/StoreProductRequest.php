<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'price' => 'required|numeric|between:0,999999.99',
            'quantity' => 'required|min:0',
            'description' => 'nullable|max:1000'
        ];
    }
}
