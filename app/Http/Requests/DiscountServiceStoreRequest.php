<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountServiceStoreRequest extends FormRequest
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
            'agent_id' => ['required', 'exists:agents,id'],
            'service_name' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'area' => ['nullable', 'string'],
            'discount_amount' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ];
    }
}
