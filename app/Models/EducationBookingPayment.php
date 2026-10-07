<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationBookingPayment extends Model
{
    protected $table = 'education_booking_payments';


    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        // Booking
        'education_booking_id',

        // Payment
        'amount',
        'currency',
        'payment_method',
        'payment_reference',
        'status',

        // Receipt
        'receipt_file',
        'receipt_original_name',
        'receipt_mime_type',
        'receipt_file_size',

        // Student submission
        'student_note',
        'submitted_at',

        // Admin review
        'reviewed_by',
        'reviewed_at',
        'admin_note',
        'rejection_reason',

        // Paid information
        'paid_at',
    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'amount' => 'decimal:2',

        'receipt_file_size' => 'integer',

        'submitted_at' => 'datetime',

        'reviewed_at' => 'datetime',

        'paid_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | BOOKING
    |--------------------------------------------------------------------------
    */

    public function booking(): BelongsTo
    {
        return $this->belongsTo(
            EducationBooking::class,
            'education_booking_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REVIEWER
    |--------------------------------------------------------------------------
    */

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(
            EducationAdmin::class,
            'reviewed_by'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STATUS HELPERS
    |--------------------------------------------------------------------------
    */

    public function isUnpaid(): bool
    {
        return $this->status === 'unpaid';
    }


    public function isSubmitted(): bool
    {
        return $this->status === 'submitted';
    }


    public function isUnderReview(): bool
    {
        return $this->status === 'under_review';
    }


    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }


    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }


    /*
    |--------------------------------------------------------------------------
    | RECEIPT PATH
    |--------------------------------------------------------------------------
    |
    | الملفات محفوظة مباشرة داخل:
    |
    | public/images/education/payments/
    |
    | وقيمة receipt_file يمكن أن تكون:
    |
    | receipt_123.jpg
    |
    | أو:
    |
    | images/education/payments/receipt_123.jpg
    |
    | لذلك نتعامل مع الحالتين.
    |
    */

    public function getReceiptUrlAttribute(): ?string
    {
        if (!$this->receipt_file) {
            return null;
        }

        $file = ltrim(
            trim($this->receipt_file),
            '/'
        );


        /*
        |--------------------------------------------------------------------------
        | إذا كانت قاعدة البيانات تحتوي على المسار الكامل
        |--------------------------------------------------------------------------
        */

        if (
            str_starts_with(
                $file,
                'images/education/payments/'
            )
        ) {
            return asset($file);
        }


        /*
        |--------------------------------------------------------------------------
        | إذا كانت قاعدة البيانات تحتوي على اسم الملف فقط
        |--------------------------------------------------------------------------
        */

        return asset(
            'images/education/payments/' . $file
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RECEIPT FILE NAME
    |--------------------------------------------------------------------------
    */

    public function getReceiptFileNameAttribute(): ?string
    {
        if (!$this->receipt_file) {
            return null;
        }

        return basename(
            trim($this->receipt_file)
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORMATTED FILE SIZE
    |--------------------------------------------------------------------------
    */

    public function getFormattedReceiptSizeAttribute(): string
    {
        if (!$this->receipt_file_size) {
            return '—';
        }


        if ($this->receipt_file_size >= 1048576) {

            return number_format(
                $this->receipt_file_size / 1048576,
                2
            ) . ' MB';
        }


        if ($this->receipt_file_size >= 1024) {

            return number_format(
                $this->receipt_file_size / 1024,
                2
            ) . ' KB';
        }


        return $this->receipt_file_size . ' B';
    }
}
