<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
            'contact' => ['required','string'],
            'email' => ['required','email'],
            'gender' => ['required', 'string','in:male,female,other'],
            'dob_year' => ['required', 'integer'],
            'dob_month' => ['required','integer'],
            'dob_day' => ['required','integer'],
            'street_no' => ['required','string'],
            'street_address' => ['required', 'string'],
            'city' => ['required','string'],
            'status' => ['required','in:active,inactive'],
        ];
    }
}
