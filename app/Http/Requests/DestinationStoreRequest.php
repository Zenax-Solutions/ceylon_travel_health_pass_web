<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationStoreRequest extends FormRequest
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
            'city_id' => ['required', 'exists:cities,id'],
            'image' => ['nullable', 'image', 'max:1024'],
            'destination' => ['required', 'string'],
            'location' => ['nullable', 'string'],
            'south_asian_price' => ['required', 'numeric'],
            'non_south_asian_price' => ['required', 'numeric'],
            'discount_price' => ['nullable', 'numeric'],
            'status' => ['required', 'string'],
        ];
    }
}
