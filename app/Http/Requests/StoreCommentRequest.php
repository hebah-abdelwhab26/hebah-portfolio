<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{ /**
     * ==================================
     * Authorization
     * ==================================
     */

    public function authorize(): bool
    {
        return true;
    }

    /**
     * ==================================
     * Validation Rules
     * ==================================
     */

    public function rules(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Visitor Information
            |--------------------------------------------------------------------------
            */

            'name' => [

                'required',

                'string',

                'max:255',

            ],

            'email' => [

                'nullable',

                'email',

                'max:255',

            ],

            /*
            |--------------------------------------------------------------------------
            | Comment
            |--------------------------------------------------------------------------
            */

            'message' => [

                'required',

                'string',

                'min:10',

                'max:3000',

            ],

            /*
            |--------------------------------------------------------------------------
            | Optional Project
            |--------------------------------------------------------------------------
            */

            'commentable_type' => [

                'nullable',

                'in:App\Models\Project',

            ],

            'commentable_id' => [

                'nullable',

                'integer',

                'exists:projects,id',

            ],

        ];
    }

    /**
     * ==================================
     * Custom Messages
     * ==================================
     */

    public function messages(): array
    {
        return [

            'name.required' =>

                'Your name is required.',

            'email.email' =>

                'Please enter a valid email address.',

            'message.required' =>

                'Please write your comment.',

            'message.min' =>

                'Your comment must contain at least 10 characters.',

            'message.max' =>

                'Your comment may not exceed 3000 characters.',

            'commentable_id.exists' =>

                'The selected project does not exist.',

            'commentable_type.in' =>

                'Invalid comment type.',

        ];
    }
}
