<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechnologyCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            'name' => [

                'required',

                'string',

                'max:255',

            ],


            'slug' => [

                'nullable',

                'string',

                'max:255',

                'unique:technology_categories,slug,' .

                optional($this->route('technologyCategory'))->id,

            ],


            'description' => [

                'nullable',

                'string',

            ],


            /*
            |--------------------------------------------------------------------------
            | Appearance
            |--------------------------------------------------------------------------
            */

            'icon' => [

                'nullable',

                'string',

                'max:255',

            ],


            'color' => [

                'nullable',

                'string',

                'max:50',

            ],


            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */

            'sort_order' => [

                'nullable',

                'integer',

                'min:0',

            ],


            'is_active' => [

                'nullable',

                'boolean',

            ],

        ];
    }


    /**
     * Validation Messages
     */
    public function messages(): array
    {
        return [

            'name.required' =>
                'Technology category name is required.',


            'slug.unique' =>
                'This slug already exists.',


            'sort_order.integer' =>
                'Sort order must be a number.',

        ];
    }
}
