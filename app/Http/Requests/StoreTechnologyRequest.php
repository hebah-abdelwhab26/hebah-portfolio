<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechnologyRequest extends FormRequest
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
            | Category
            |--------------------------------------------------------------------------
            */

            'technology_category_id' => [

                'required',

                'exists:technology_categories,id',

            ],

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

                'unique:technologies,slug,' .
                optional($this->route('technology'))->id,

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
            | Website
            |--------------------------------------------------------------------------
            */

            'website' => [

                'nullable',

                'url',

                'max:255',

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

            'technology_category_id.required' =>
                'Technology category is required.',

            'technology_category_id.exists' =>
                'Selected category does not exist.',

            'name.required' =>
                'Technology name is required.',

            'slug.unique' =>
                'This slug already exists.',

            'website.url' =>
                'Please enter a valid website URL.',

            'sort_order.integer' =>
                'Sort order must be a number.',

        ];
    }
}

