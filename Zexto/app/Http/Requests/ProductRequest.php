<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
        if($request->id != null)
        {
            $main_and_sub_1_2_image_validation = 'bail|nullable|mimes:jpeg,bmp,png|max:20480';
        } else
        {
            $main_and_sub_1_2_image_validation = 'bail|required|mimes:jpeg,bmp,png|max:20480';
        }
        return [
            'product_name' => 'required|string|max:255',
            'product_for' => 'required|string|max:255',
            'product_introduction' => 'bail|required|string',
            'product_features' => 'bail|required|string',
            'product_amount' => 'bail|required|numeric|regex:/^\d*\.?\d*$/i|between:0,2147483647',
            'product_previous_amount' => 'bail|required|numeric|regex:/^\d*\.?\d*$/i|between:0,2147483647',
            'product_colors' => 'required|string|max:255',
            'product_size' => 'required|string|max:255',
            'product_weight' => 'required|numeric|between:0,2147483647',
            'product_stock' => 'required|numeric|between:0,2147483647',
            'product_tags' => 'bail|required|string',
            'product_main_image' => $main_and_sub_1_2_image_validation,
            'product_description_image' => 'bail|nullable|mimes:jpeg,bmp,png|max:20480',
            'product_sub_image_1' => $main_and_sub_1_2_image_validation,
            'product_sub_image_2' => $main_and_sub_1_2_image_validation,
            'product_sub_image_3' => 'bail|nullable|mimes:jpeg,bmp,png|max:20480',
            'product_sub_image_4' => 'bail|nullable|mimes:jpeg,bmp,png|max:20480',
            'product_sub_image_5' => 'bail|nullable|mimes:jpeg,bmp,png|max:20480',
            'product_sub_image_6' => 'bail|nullable|mimes:jpeg,bmp,png|max:20480',

        ];
    }


    public function messages()
    {
        return [
            'product_main_image.required' => 'Product main image cannot be empty.',
            'product_sub_image_1.required' => 'Sub-image 1 cannot be empty.',
            'product_sub_image_2.required' => 'Sub-image 2 cannot be empty.',
            '*.required' => 'Field cannot be empty.',
            '*.numeric' => 'Field Must Contain a Number',
            '*.regex' => 'Format invalid, must be a Decimal number like 0.00',
            'product_main_image.max' => 'Product main image file cannot be more than 20MB.',
            'product_description_image.max' => 'Product description image file cannot be more than 20MB.',
            'product_sub_image_1.max' => 'Sub-image 1 file cannot be more than 20MB.',
            'product_sub_image_2.max' => 'Sub-image 2 file cannot be more than 20MB.',
            'product_sub_image_3.max' => 'Sub-image 3 file cannot be more than 20MB.',
            'product_sub_image_4.max' => 'Sub-image 4 file cannot be more than 20MB.',
            'product_sub_image_5.max' => 'Sub-image 5 file cannot be more than 20MB.',
            'product_sub_image_6.max' => 'Sub-image 6 file cannot be more than 20MB.',
            'product_main_image.mimes' => 'Product main image file extension had to be of -> .jpeg/.bmp/.png ',
            'product_description_image.mimes' => 'Product description image file extension had to be of -> .jpeg/.bmp/.png ',
            'product_sub_image_1.mimes' => 'Sub-image 1 file extension had to be of -> .jpeg/.bmp/.png ',
            'product_sub_image_2.mimes' => 'Sub-image 2 file extension had to be of -> .jpeg/.bmp/.png ',
            'product_sub_image_3.mimes' => 'Sub-image 3 file extension had to be of -> .jpeg/.bmp/.png ',
            'product_sub_image_4.mimes' => 'Sub-image 4 file extension had to be of -> .jpeg/.bmp/.png ',
            'product_sub_image_5.mimes' => 'Sub-image 5 file extension had to be of -> .jpeg/.bmp/.png ',
            'product_sub_image_6.mimes' => 'Sub-image 6 file extension had to be of -> .jpeg/.bmp/.png ',
            'product_amount.between' => 'Amount cannot exceeds more than 10 digits.',
            'product_previous_amount.between' => 'Amount cannot exceeds more than 10 digits.',
            'product_stock.between' => 'Stock cannot exceeds more than 10 digits.',
            'product_weight.between' => 'Weight cannot exceeds more than 10 digits.',
            '*.max' => 'Characters cannot exceeds more than 255 characters',
        ];
    }
}
