<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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

            'name' => [
                'required',
                'string',
                'max:255',
            ],


            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')
                    ->ignore($this->user->id),
            ],


            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($this->user->id),
            ],


            'password' => [
                'nullable',
                'string',
                'min:8',
            ],


            'role' => [
                'required',
                'string',
            ],


            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],


            'email_verified' => [
                'nullable',
                'boolean',
            ],


           'status' => [
    'nullable',
    'in:active,inactive,blocked',
],

        ];
    }



    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [

            'name.required' =>
                'Name is required.',


            'username.required' =>
                'Username is required.',


            'username.unique' =>
                'Username already exists.',


            'email.required' =>
                'Email is required.',


            'email.unique' =>
                'Email already exists.',


            'password.min' =>
                'Password must be at least 8 characters.',


            'avatar.image' =>
                'Avatar must be an image.',


            'avatar.max' =>
                'Avatar size cannot exceed 2MB.',

        ];
    }
}
