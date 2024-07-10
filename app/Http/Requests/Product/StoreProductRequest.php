<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],

            'price' => [
                'required',
            ],

            'description' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],

            'image' => [
                'required',
                'image',
                'mimes:png,jpg,jpeg',
            ],

            'weight' => [
                'required'
            ],

            'min_weight' => [
                'required',
            ],

            'country_origin' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],

            'quality' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],

            'check' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],

            'category_id' => [
                'required',
            ]
        ];
    }
}