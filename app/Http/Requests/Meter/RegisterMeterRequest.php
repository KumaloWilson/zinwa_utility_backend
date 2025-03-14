<?php

namespace App\Http\Requests\Meter;

use Illuminate\Foundation\Http\FormRequest;

class RegisterMeterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'meter_number' => 'required|string|max:255|unique:meters',
            'meter_type' => 'sometimes|string|in:prepaid,postpaid',
            'location' => 'nullable|string|max:255',
            'installation_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'validate' => 'sometimes|boolean',
        ];
    }
}

