<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
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
            'contact' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:clients,email'],
            'gender' => ['required','in:male,female,other'],
            'dob_year' => ['required' ,'integer'],
            'dob_month' => ['required', 'integer' ,'min:1','max:12'],
            'dob_day' => ['required','integer','min:1','max:31'],
            'street_no' => ['required','string'],
            'street_address' => ['required','string'],
            'city' => ['required','string'],
            'status' => ['nullable','in:active,inactive'],
        ];
    }

    public function messages()
    {
        return [
            'dob_month.max' => 'Please select a valid month.',
            'dob_day.max' => 'Please select a valid day for the selected month.',
        ];
    }
}
