<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
                Rule::unique('projects', 'slug')->ignore($this->project),
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
            | Display Content
            |--------------------------------------------------------------------------
            */

            'display_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'badge' => [
                'nullable',
                'string',
                'max:255',
            ],

            'hero_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'hero_subtitle' => [
                'nullable',
                'string',
            ],

            'card_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'card_description' => [
                'nullable',
                'string',
            ],

            'button_text' => [
                'nullable',
                'string',
                'max:100',
            ],

            'button_url' => [
                'nullable',
                'url',
            ],

            'layout' => [
                'nullable',
                Rule::in([
                    'default',
                    'wide',
                    'featured',
                ]),
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
            | SEO
            |--------------------------------------------------------------------------
            */

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            /*
            |--------------------------------------------------------------------------
            | Details
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
            | Settings
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'published',
                ]),
            ],

            'featured' => [
                'nullable',
                'boolean',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'show_on_home' => [
                'nullable',
                'boolean',
            ],

            'show_in_portfolio' => [
                'nullable',
                'boolean',
            ],

            'show_in_services' => [
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
