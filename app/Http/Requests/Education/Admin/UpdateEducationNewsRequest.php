<?php

namespace App\Http\Requests\Education\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEducationNewsRequest extends FormRequest
{
    /**
     * تحديد صلاحية تنفيذ الطلب.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قواعد التحقق.
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'nullable',
                'string',
            ],

            'type' => [
                'required',
                'string',
                Rule::in([
                    'announcement',
                    'lesson',
                    'update',
                    'notice',
                    'general',
                ]),
            ],

            'link' => [
                'nullable',
                'string',
                'max:2048',
                'url',
            ],

            'link_text' => [
                'nullable',
                'string',
                'max:100',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
                'max:999999',
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],
        ];
    }

    /**
     * تحويل البيانات قبل التحقق.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'sort_order' => $this->input('sort_order', 0),
        ]);
    }

    /**
     * رسائل التحقق بالعربية.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الخبر مطلوب.',
            'title.string' => 'عنوان الخبر يجب أن يكون نصًا.',
            'title.max' => 'عنوان الخبر لا يمكن أن يتجاوز 255 حرفًا.',

            'content.string' => 'محتوى الخبر يجب أن يكون نصًا.',

            'type.required' => 'نوع الخبر مطلوب.',
            'type.in' => 'نوع الخبر المحدد غير صالح.',

            'link.url' => 'رابط الخبر يجب أن يكون رابطًا صحيحًا.',
            'link.max' => 'رابط الخبر طويل جدًا.',

            'link_text.max' => 'نص الرابط لا يمكن أن يتجاوز 100 حرف.',

            'icon.max' => 'اسم الأيقونة طويل جدًا.',

            'is_active.boolean' => 'حالة الخبر غير صحيحة.',

            'sort_order.integer' => 'ترتيب الخبر يجب أن يكون رقمًا صحيحًا.',
            'sort_order.min' => 'ترتيب الخبر لا يمكن أن يكون أقل من صفر.',

            'starts_at.date' => 'تاريخ بداية الظهور غير صحيح.',

            'ends_at.date' => 'تاريخ نهاية الظهور غير صحيح.',
            'ends_at.after_or_equal' => 'تاريخ نهاية الظهور يجب أن يكون بعد أو مساويًا لتاريخ البداية.',
        ];
    }

    /**
     * أسماء الحقول بالعربية.
     */
    public function attributes(): array
    {
        return [
            'title' => 'عنوان الخبر',
            'content' => 'محتوى الخبر',
            'type' => 'نوع الخبر',
            'link' => 'الرابط',
            'link_text' => 'نص الرابط',
            'icon' => 'الأيقونة',
            'is_active' => 'حالة الخبر',
            'sort_order' => 'الترتيب',
            'starts_at' => 'بداية الظهور',
            'ends_at' => 'نهاية الظهور',
        ];
    }
}
