<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'comment' => [
                'required',
                'string',
                'min:3',
                'max:2000',
            ],
        ];
    }

    /**
     * Validation messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'يرجى كتابة الاسم.',
            'name.string' => 'الاسم غير صالح.',
            'name.min' => 'يجب أن يحتوي الاسم على حرفين على الأقل.',
            'name.max' => 'الاسم طويل جدًا.',

            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.max' => 'البريد الإلكتروني طويل جدًا.',

            'comment.required' => 'يرجى كتابة التعليق.',
            'comment.string' => 'التعليق غير صالح.',
            'comment.min' => 'يجب أن يحتوي التعليق على 3 أحرف على الأقل.',
            'comment.max' => 'التعليق طويل جدًا.',
        ];
    }
}
