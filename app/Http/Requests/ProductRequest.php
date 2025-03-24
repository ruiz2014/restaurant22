<?php

namespace App\Http\Requests;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'name' => 'required|string',
			'description' => 'string',
			'price' => 'required',
			'category_id' => 'required',
			'provider_id' => 'required',
            'stock' => 'nullable',
			'minimo' => 'nullable',
			// 'status' => 'required',

            // 'service_id' => 'integer',
			// 'category_id' => 'integer',
			// 'provider_id' => 'integer'
        ];
    }
}
