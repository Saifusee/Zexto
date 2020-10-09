<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class EditRegisterRequest extends FormRequest
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
    public function rules(Request $request)
    {
        //Getting the user.
       $user =  User::find($request->id);
       // user not change his username and email we don't want the unique functionality here, only if he change them then check if its already exist or not.
        if($request->username == $user->username)
        {
            $userValidationRuleUsername = 'required|string|max:255';
        } else
        {
            $userValidationRuleUsername = 'required|string|unique:users,username|max:255';
        }
        if($request->email == $user->email)
        {
            $userValidationRuleEmail = 'bail|required|string|max:255|regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i';
        } else
        {
            $userValidationRuleEmail = 'bail|required|string|unique:users,email|max:255|regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i';
        }
        // if($request->profile_picture == null || $request->profile_picture == 'undefined')
        // {
        //     $userProfile
        // }
        return [
            'username' => $userValidationRuleUsername,
            'email' => $userValidationRuleEmail,
            'firstname' => 'bail|string',
            'lastname' => 'bail|string',
            'is_admin' => 'bail|boolean|max:1|min:1',
            'is_vendor' => 'bail|boolean|max:1|min:1',
            'profile_picture' => 'bail|nullable|mimes:jpeg,bmp,png|max:20480'
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
            'firstname.string' => 'Firstname is of Invalid Data Type',
            'lastname.string' => 'Lastname is of Invalid Data Type',
            'profile_picture.max' => 'Profile-image file cannot be more than 20MB.',
            'profile_picture.mimes' => 'Profile-image file extension had to be of -> .jpeg/.bmp/.png ',
        ];
    }
}
