<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentStoreRequest extends FormRequest
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
            'type' => ['required', 'string'],
            'profile_image' => ['image', 'max:1024', 'nullable'],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'contact_no' => ['required', 'string'],
            'id_no' => ['nullable', 'string'],
            'license_no' => ['nullable', 'string'],
            'bank_details' => ['nullable', 'string'],
            'points' => ['nullable'],
            'commission' => ['nullable'],
            'commission_payment_status' => ['nullable', 'string'],
            'commission_payment_date' => ['nullable', 'date'],
            'recent_commission_payment_date' => ['nullable', 'date'],
            'recent_info' => ['nullable', 'string'],
            'coupon_code' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
        ];
    }
}
