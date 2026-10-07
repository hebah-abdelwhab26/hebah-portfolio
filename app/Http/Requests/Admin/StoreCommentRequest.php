<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
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
            | User Information
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

            ],

            /*
            |--------------------------------------------------------------------------
            | Optional Relation
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

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [

                'required',

                'in:pending,approved,rejected',

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

                'Name is required.',

            'name.max' =>

                'Name may not be greater than 255 characters.',

            'email.email' =>

                'Please enter a valid email address.',

            'message.required' =>

                'Comment message is required.',

            'commentable_type.in' =>

                'Invalid comment type.',

            'commentable_id.exists' =>

                'The selected project does not exist.',

            'status.required' =>

                'Comment status is required.',

            'status.in' =>

                'Invalid comment status.',

        ];
    }
}
