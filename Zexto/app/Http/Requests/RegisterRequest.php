<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|unique:users,username|max:255',
            'email' => 'bail|required|string|unique:users,email|max:255|regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i',
            'is_vendor' => 'bail|required|boolean|max:1|min:1',
            'password' => 'bail|required|string|confirmed|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S*[\W]).{8,32}$/i',
            'password_confirmation' => 'bail|required|string|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S*[\W]).{8,32}$/i'
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'E-mail field cannot be empty.',
            'email.unique' => 'There\'s already a User Account with the given E-mail',
            'email.max' => 'E-mail too long, cannot exceed more than 255 characters.',
            'email.regex' => 'E-mail format invalid, must follow example@mail.com',
            'username.required' => 'Username field cannot be empty.',
            'username.unique' => 'There\'s already a User Account with the given Username',
            'username.max' => 'Username too long, cannot exceed more than 255 characters.',
            'is_vendor.required' => 'You must have to select one User Status.',
            'password.required' => 'Password field cannot be empty.',
            'password.confirmed' => 'Password didn\'t match with the Confirm Password field, Please make sure uppercase and lowercase letters on both fields.',
            'password.regex' => 'Password format invalid, Must include one uppercase letter, one lowercase letter, one number and a special characters.',
            'password_confirmation.required' => 'Password Confirmation field cannot be empty.',
            'password_confirmation.regex' => 'Password format invalid, Must include one uppercase letter, one lowercase letter, one number and a special characters.',
        ];
    }
}
