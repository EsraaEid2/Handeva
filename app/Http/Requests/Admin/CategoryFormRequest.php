<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ];
    }

        /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    
     public function messages()
     {
         return [
             'name.required' => 'The category name is required.',
             'name.string' => 'The category name must be a string.',
             'name.max' => 'The category name must not exceed 255 characters.',
             'description.string' => 'The description must be a string.',
             'description.max' => 'The description must not exceed 500 characters.',
             'image.image' => 'The file must be an image.',
             'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
             'image.max' => 'The image size must not exceed 2MB.',
         ];
     }

}