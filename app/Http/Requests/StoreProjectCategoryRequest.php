<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectCategoryRequest extends FormRequest
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
                'unique:project_categories,slug,' .
                optional($this->route('projectCategory'))->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Category Type
            |--------------------------------------------------------------------------
            */

            'type' => [
                'required',
                'in:development,design',
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

            'name.required' => 'Category name is required.',

            'slug.unique' => 'This slug already exists.',

            'type.required' => 'Category type is required.',

            'type.in' => 'Invalid category type selected.',

            'sort_order.integer' => 'Sort order must be a number.',

        ];
    }
}
