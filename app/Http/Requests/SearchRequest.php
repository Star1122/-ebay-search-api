<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'keywords' => 'required|string|max:255',
            'price_min' => 'numeric|lte:price_max',
            'price_max' => 'numeric|gte:price_min',
            'sorting' => 'required|in:default,by_price_asc',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute field must be numeric.',
            'price_min.let' => '"price_min" value must be less or equal than "price_max".',
            'price_max.gte' => '"price_max" value must be greater or equal than "price_min".',
            'sorting.in' => '"sorting" value must be default or by_price_asc.',
        ];
    }
}
