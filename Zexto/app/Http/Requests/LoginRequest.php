<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
                'usernameOrEmail' => 'bail|required|string|max:255',
                'password' => 'bail|required|string|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S*[\W]).{8,32}$/i',
            ];
    }

    public function messages()
    {
        return [
            'usernameOrEmail.required' => 'E-mail or Username field cannot be empty.',
            'usernameOrEmail.max' => 'E-mail or Username too long, cannot exceed more than 255 characters.',
            'password.required' => 'Password field cannot be empty.',
            'password.regex' => 'Password format invalid, Must include one uppercase letter, one lowercase letter, one number and a special characters.',
        ];
    }
}
