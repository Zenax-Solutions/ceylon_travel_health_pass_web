<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageUpdateRequest extends FormRequest
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
            'main_title' => ['required', 'string'],
            'second_title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'travel_info' => ['nullable', 'string'],
            'health_info' => ['nullable', 'string'],
            'days' => ['nullable'],
            'expire_days_count' => ['required'],
            'price' => ['required', 'numeric'],
            'child_price' => ['nullable', 'numeric'],
            'additional_per_adult_price' => ['nullable', 'numeric'],
            'additional_per_day_price' => ['nullable', 'numeric'],
            'discount_shop_list' => ['nullable', 'json'],
            'discount_service_list' => ['required', 'json'],
        ];
    }
}
