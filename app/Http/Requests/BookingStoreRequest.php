<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingStoreRequest extends FormRequest
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
            'package_id' => ['required', 'exists:packages,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'adult_pass_count' => ['required'],
            'child_pass_count' => ['nullable'],
            'total' => ['required', 'numeric'],
            'destination_list' => ['required', 'json'],
            'esim_list' => ['required', 'json'],
            'date' => ['required', 'date'],
            'payment_status' => ['required', 'string'],
        ];
    }
}
