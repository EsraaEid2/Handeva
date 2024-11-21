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
    public function rules(): array
    {
        $rules = [
          'name'=>[
            'required',
            'string',
            'max:200'
          ],
          'description'=>[
            'required',
            'string'
          ],
          'image'=>[
            'nullable',
            'mimes:jpeg,jpg,png',
            'max:2048' // Max size in KB (2MB)
          ],
        ];
        return  $rules;
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
            'name.max' => 'The category name must not exceed 200 characters.',
            'description.required' => 'A description is required.',
            'image.required' => 'Please upload an image for the category.',
            'image.mimes' => 'The image must be in JPEG, JPG, or PNG format.',
            'image.max' => 'The image size must not exceed 2MB.',
        ];
    }

}