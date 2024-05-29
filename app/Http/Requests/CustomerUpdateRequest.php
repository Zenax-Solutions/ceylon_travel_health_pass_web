<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'max:1024'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['nullable'],
            'region_type' => ['required', 'string'],
            'contact_no' => ['nullable', 'string'],
            'whatsapp_no' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ];
    }
}
