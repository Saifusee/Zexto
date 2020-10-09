<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddBlogRequest extends FormRequest
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
            $main_image_validation = 'bail|nullable|mimes:jpeg,bmp,png|max:20480';
        } else
        {
            $main_image_validation = 'bail|required|mimes:jpeg,bmp,png|max:20480';
        }
        return [
            'blog_title' => 'bail|required|string|max:255',
            'blog_data_1' => 'bail|required|string',
            'blog_quote_author' => 'bail|max:255',
            'category_tag' => 'bail|required|string|max:255',
            'blog_main_image' => $main_image_validation,
            'blog_sub_image_1' => 'bail|nullable|mimes:jpeg,bmp,png|max:20480',
            'blog_sub_image_2' => 'bail|nullable|mimes:jpeg,bmp,png|max:20480',
            'blog_sub_image_3' => 'bail|nullable|mimes:jpeg,bmp,png|max:20480',

        ];
    }


    public function messages()
    {
        return [
            'blog_title.required' => 'Title Field cannot be empty.',
            'blog_title.max' => 'Blog title cannot be more than 255 characters.',
            'blog_data_1.required' => 'Blog Data Field cannot be empty.',
            'blog_main_image.required' => 'Main Image had to be uploaded, cannot be empty.',
            'blog_main_image.max' => 'Blog main-image file cannot be more than 20MB.',
            'blog_main_image.mimes' => 'Main image file extension had to be of -> .jpeg/.bmp/.png ',
            'blog_sub_image_1.max' => 'Sub-image 1 file cannot be more than 20MB.',
            'blog_sub_image_1.mimes' => 'Sub-image 1 file extension had to be of -> .jpeg/.bmp/.png ',
            'blog_sub_image_2.max' => 'Sub-image 2 file cannot be more than 20MB.',
            'blog_sub_image_2.mimes' => 'Sub-image 2 file extension had to be of -> .jpeg/.bmp/.png ',
            'blog_sub_image_3.max' => 'Sub-image 3 file file cannot be more than 20MB.',
            'blog_sub_image_3.mimes' => 'Sub-image 3 file extension had to be of -> .jpeg/.bmp/.png ',
            'category_tag.max' => 'Category Tag cannot be more than 255 characters.',
            'category_tag.required' => 'Blog category field cannot be empty.',
            'blog_quote_author.max' => 'Quote Author Name cannot be more than 255 characters.',
        ];
    }
}
