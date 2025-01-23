<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
			'name' => 'required|min:8|max:64|regex:/^[\pL\s\-]+$/u',
			'tipo_doc' => 'numeric',
			'document' => 'numeric|min_digits:8|max_digits:11', //digits_between:8,11',
			'phone' => 'numeric|nullable',
			'address' => 'string|nullable',
			'email' => 'email|nullable',
			'ubigeo' => 'numeric|nullable',
			'status' => 'required|numeric',
        ];
    }
}
