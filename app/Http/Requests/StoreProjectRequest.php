<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],

            'slug' => [
    'nullable',
    'string',
    'max:255',
    'unique:projects,slug',
],

            'short_description' => [
                'nullable',
                'string',
            ],

            'description' => [
                'required',
                'string',
            ],

            /*
            |--------------------------------------------------------------------------
            | Project Links
            |--------------------------------------------------------------------------
            */

            'live_demo' => [
                'nullable',
                'url',
            ],

            'github' => [
                'nullable',
                'url',
            ],

            'figma' => [
                'nullable',
                'url',
            ],

            /*
            |--------------------------------------------------------------------------
            | Project Details
            |--------------------------------------------------------------------------
            */

            'client' => [
                'nullable',
                'string',
                'max:255',
            ],

            'project_date' => [
                'nullable',
                'date',
            ],

            'duration' => [
                'nullable',
                'string',
                'max:255',
            ],

            /*
            |--------------------------------------------------------------------------
            | Publish Settings
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                'in:draft,published',
            ],

            'featured' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            /*
            |--------------------------------------------------------------------------
            | Category
            |--------------------------------------------------------------------------
            */

            'project_category_id' => [
                'required',
                'exists:project_categories,id',
            ],

            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'gallery' => [
                'nullable',
                'array',
            ],

            'gallery.*' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            /*
            |--------------------------------------------------------------------------
            | Technologies
            |--------------------------------------------------------------------------
            */

            'technologies' => [
                'nullable',
                'array',
            ],

            'technologies.*' => [
                'exists:technologies,id',
            ],

        ];
    }
}
