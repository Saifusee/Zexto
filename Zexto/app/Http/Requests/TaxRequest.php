<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tax_name' => 'required',
            'tax_percentage' => 'bail|required|numeric|regex:/^\d*\.?\d*$/i|between:0,100.00',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'Field cannot be empty.',
            'tax_percentage.numeric' => 'Percentage should be a number',
            'tax_percentage.regex' => 'Invalid Data, should be in format 0.00',
            'tax_percentage.between' => 'Percentage should be between 0.00 and 100.00'
        ];
    }
}
