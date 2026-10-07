@extends('education.layouts.app')

@section('title', __('education.booking_show_page.page_title'))

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | BOOKING DATA
    |--------------------------------------------------------------------------
    */

    $totalSessions = (int) ($booking->total_sessions ?? 1);

    $completedSessions = (int) ($booking->completed_sessions ?? 0);

    $remainingSessions = max(
        0,
        $totalSessions - $completedSessions
    );


    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    $payment = $booking->payment;

    $paymentStatus = $payment?->status ?? 'unpaid';


    /*
    |--------------------------------------------------------------------------
    | BOOKING TYPE
    |--------------------------------------------------------------------------
    */

    $bookingType = $booking->bookingType;

    $bookingTypeTitle = $bookingType?->title
        ?? $bookingType?->name
        ?? __('education.booking_show_page.fallback.lesson');


    /*
    |--------------------------------------------------------------------------
    | CATEGORY / SUBJECT
    |--------------------------------------------------------------------------
    */

    $category = $bookingType?->category
        ?? $bookingType?->type
        ?? null;


    /*
    |--------------------------------------------------------------------------
    | DATE
    |--------------------------------------------------------------------------
    */

    $bookingDate = $booking->booking_date;


    /*
    |--------------------------------------------------------------------------
    | STATUS LABEL
    |--------------------------------------------------------------------------
    */

    $statusLabel = match ($booking->status) {

        'confirmed' => __('education.booking_show_page.status.confirmed'),

        'pending' => __('education.booking_show_page.status.pending'),

        'completed' => __('education.booking_show_page.status.completed'),

        'cancelled' => __('education.booking_show_page.status.cancelled'),

        'rejected' => __('education.booking_show_page.status.rejected'),

        'no_show' => __('education.booking_show_page.status.no_show'),

        default => $booking->status ?? __('education.booking_show_page.status.unknown'),
    };


    /*
    |--------------------------------------------------------------------------
    | STATUS ICON
    |--------------------------------------------------------------------------
    */

    $statusIcon = match ($booking->status) {

        'confirmed' => 'fa-solid fa-circle-check',

        'completed' => 'fa-solid fa-graduation-cap',

        'cancelled' => 'fa-solid fa-calendar-xmark',

        'rejected' => 'fa-solid fa-circle-xmark',

        'no_show' => 'fa-solid fa-user-xmark',

        default => 'fa-regular fa-clock',
    };


    /*
    |--------------------------------------------------------------------------
    | PAYMENT LABEL
    |--------------------------------------------------------------------------
    */

    $paymentLabel = match ($paymentStatus) {

        'approved' => __('education.booking_show_page.payment.approved'),

        'submitted' => __('education.booking_show_page.payment.submitted'),

        'under_review' => __('education.booking_show_page.payment.under_review'),

        'rejected' => __('education.booking_show_page.payment.rejected'),

        'failed' => __('education.booking_show_page.payment.failed'),

        default => __('education.booking_show_page.payment.unpaid'),
    };


    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSONS
    |--------------------------------------------------------------------------
    */

    $studentLessons = $booking->studentLessons ?? collect();

    $activeLessons = $studentLessons->where('is_active', true);

    $lessonsAvailable = $paymentStatus === 'approved'
        && $activeLessons->isNotEmpty();
@endphp


<style>

/*
|--------------------------------------------------------------------------
| BOOKING SHOW
|--------------------------------------------------------------------------
*/

.education-booking-show {
    width: 100%;
}

.education-booking-show-container {
    width: min(1180px, calc(100% - 32px));
    margin: 0 auto;
    padding: 35px 0 60px;
}


/*
|--------------------------------------------------------------------------
| TOPBAR
|--------------------------------------------------------------------------
*/

.education-booking-show-topbar {
    margin-bottom: 25px;
}

.education-booking-show-back {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    color: #6f8068;
    text-decoration: none;
    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    font-weight: 700;
    transition: .25s ease;
}

.education-booking-show-back:hover {
    color: #b99552;
}

.education-booking-show-back i {
    transition: .25s ease;
}

.education-booking-show-back:hover i {
    transform: translateX(4px);
}


/*
|--------------------------------------------------------------------------
| HEADER
|--------------------------------------------------------------------------
*/

.education-booking-show-header {
    margin-bottom: 28px;
}

.education-booking-show-eyebrow {
    display: inline-block;
    margin-bottom: 7px;
    color: #b99552;
    font-family: 'Cairo', sans-serif;
    font-size: 12px;
    font-weight: 800;
}

.education-booking-show-header h1 {
    margin: 0 0 8px;
    color: #403b32;
    font-family: 'Amiri', serif;
    font-size: 38px;
    line-height: 1.4;
}

.education-booking-show-header p {
    margin: 0;
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 14px;
    line-height: 1.9;
}


/*
|--------------------------------------------------------------------------
| ALERT
|--------------------------------------------------------------------------
*/

.education-booking-show-alert {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 22px;
    padding: 15px 18px;
    border-radius: 14px;
    background: rgba(111, 128, 104, .10);
    border: 1px solid rgba(111, 128, 104, .18);
    color: #5e7058;
    font-family: 'Cairo', sans-serif;
    font-size: 13px;
}

.education-booking-show-alert-danger {
    background: rgba(170, 75, 75, .08);
    border-color: rgba(170, 75, 75, .16);
    color: #a04d4d;
}


/*
|--------------------------------------------------------------------------
| HERO
|--------------------------------------------------------------------------
*/

.education-booking-show-hero {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;
    padding: 30px;
    margin-bottom: 25px;
    border-radius: 24px;
    background: linear-gradient(
        135deg,
        #fffdf8 0%,
        #f5efe1 100%
    );
    border: 1px solid rgba(185, 149, 82, .20);
    box-shadow: 0 12px 35px rgba(70, 58, 35, .06);
    overflow: hidden;
}

.education-booking-show-hero::before {
    content: '';
    position: absolute;
    width: 190px;
    height: 190px;
    left: -70px;
    bottom: -90px;
    border-radius: 50%;
    background: rgba(185, 149, 82, .07);
}

.education-booking-show-hero-content {
    position: relative;
    z-index: 1;
}

.education-booking-show-hero-label {
    display: block;
    margin-bottom: 6px;
    color: #b99552;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 800;
}

.education-booking-show-hero h2 {
    margin: 0 0 7px;
    color: #403b32;
    font-family: 'Amiri', serif;
    font-size: 30px;
}

.education-booking-show-hero p {
    margin: 0;
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    line-height: 1.9;
}

.education-booking-show-hero-icon {
    position: relative;
    z-index: 1;
    flex: 0 0 70px;
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
    background: rgba(111, 128, 104, .12);
    color: #6f8068;
    font-size: 28px;
}


/*
|--------------------------------------------------------------------------
| GRID
|--------------------------------------------------------------------------
*/

.education-booking-show-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.8fr) minmax(280px, .9fr);
    gap: 22px;
    align-items: start;
}

.education-booking-show-card {
    padding: 25px;
    border-radius: 22px;
    background: #fff;
    border: 1px solid rgba(64, 59, 50, .08);
    box-shadow: 0 10px 30px rgba(70, 58, 35, .045);
}

.education-booking-show-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 22px;
}

.education-booking-show-card-header-label {
    display: block;
    margin-bottom: 4px;
    color: #b99552;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 800;
}

.education-booking-show-card-header h3 {
    margin: 0;
    color: #403b32;
    font-family: 'Amiri', serif;
    font-size: 24px;
}

.education-booking-show-card-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: rgba(185, 149, 82, .10);
    color: #b99552;
    font-size: 18px;
}


/*
|--------------------------------------------------------------------------
| STATUS
|--------------------------------------------------------------------------
*/

.education-booking-show-status {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 12px;
    border-radius: 30px;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 800;
}

.education-booking-show-status.confirmed {
    background: rgba(111, 128, 104, .11);
    color: #60735a;
}

.education-booking-show-status.pending {
    background: rgba(185, 149, 82, .12);
    color: #a27f43;
}

.education-booking-show-status.completed {
    background: rgba(111, 128, 104, .12);
    color: #5e7058;
}

.education-booking-show-status.cancelled,
.education-booking-show-status.rejected {
    background: rgba(170, 75, 75, .09);
    color: #a04d4d;
}


/*
|--------------------------------------------------------------------------
| LESSON
|--------------------------------------------------------------------------
*/

.education-booking-show-lesson {
    display: flex;
    align-items: flex-start;
    gap: 17px;
    padding: 20px;
    margin-bottom: 22px;
    border-radius: 18px;
    background: #faf8f2;
    border: 1px solid rgba(185, 149, 82, .12);
}

.education-booking-show-lesson-icon {
    flex: 0 0 54px;
    width: 54px;
    height: 54px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    background: rgba(111, 128, 104, .12);
    color: #6f8068;
    font-size: 22px;
}

.education-booking-show-lesson-content {
    min-width: 0;
}

.education-booking-show-lesson-category {
    display: block;
    margin-bottom: 4px;
    color: #b99552;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 800;
}

.education-booking-show-lesson-content h4 {
    margin: 0 0 6px;
    color: #403b32;
    font-family: 'Amiri', serif;
    font-size: 25px;
}

.education-booking-show-lesson-content p {
    margin: 0;
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    line-height: 1.9;
}


/*
|--------------------------------------------------------------------------
| DETAILS
|--------------------------------------------------------------------------
*/

.education-booking-show-details {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
    margin-bottom: 20px;
}

.education-booking-show-detail {
    padding: 16px;
    border-radius: 15px;
    background: #fcfbf8;
    border: 1px solid rgba(64, 59, 50, .06);
}

.education-booking-show-detail-label {
    display: block;
    margin-bottom: 7px;
    color: #8b8375;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}

.education-booking-show-detail-value {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    font-weight: 700;
}

.education-booking-show-detail-value i {
    color: #b99552;
}


/*
|--------------------------------------------------------------------------
| PRICE
|--------------------------------------------------------------------------
*/

.education-booking-show-price {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding: 18px 20px;
    margin-bottom: 18px;
    border-radius: 16px;
    background: #f5efe1;
}

.education-booking-show-price-label {
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 12px;
}

.education-booking-show-price-value {
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 19px;
    font-weight: 800;
}

.education-booking-show-price-currency {
    margin-right: 4px;
    color: #b99552;
    font-size: 12px;
}


/*
|--------------------------------------------------------------------------
| PAYMENT
|--------------------------------------------------------------------------
*/

.education-booking-show-payment {
    padding: 18px;
    margin-bottom: 18px;
    border-radius: 16px;
    background: #faf8f2;
    border: 1px solid rgba(64, 59, 50, .06);
}

.education-booking-show-payment-status {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.education-booking-show-payment-label {
    display: block;
    margin-bottom: 4px;
    color: #8b8375;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}

.education-booking-show-payment-value {
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    font-weight: 700;
}

.education-booking-show-payment-badge {
    padding: 6px 11px;
    border-radius: 20px;
    background: rgba(185, 149, 82, .12);
    color: #a27f43;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    font-weight: 800;
}

.education-booking-show-payment-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    padding-top: 12px;
    margin-top: 12px;
    border-top: 1px solid rgba(64, 59, 50, .06);
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}

.education-booking-show-payment-meta span {
    color: #8b8375;
}

.education-booking-show-payment-meta strong {
    color: #403b32;
}


/*
|--------------------------------------------------------------------------
| PAYMENT ACTION
|--------------------------------------------------------------------------
*/

.education-booking-show-payment-action {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    padding: 18px;
    margin-bottom: 18px;
    border-radius: 17px;
    background: rgba(185, 149, 82, .07);
    border: 1px solid rgba(185, 149, 82, .14);
}

.education-booking-show-payment-action strong {
    display: block;
    margin-bottom: 4px;
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 13px;
}

.education-booking-show-payment-action p {
    margin: 0;
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    line-height: 1.8;
}

.education-booking-show-payment-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 43px;
    padding: 0 17px;
    border-radius: 12px;
    background: #6f8068;
    color: #fff;
    text-decoration: none;
    white-space: nowrap;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 800;
}

.education-booking-show-payment-button:hover {
    background: #5e7058;
    color: #fff;
}


/*
|--------------------------------------------------------------------------
| PAYMENT MESSAGES
|--------------------------------------------------------------------------
*/

.education-booking-show-payment-pending,
.education-booking-show-payment-approved {
    display: flex;
    align-items: flex-start;
    gap: 13px;
    padding: 17px;
    margin-bottom: 18px;
    border-radius: 16px;
}

.education-booking-show-payment-pending {
    background: rgba(185, 149, 82, .08);
    color: #a27f43;
}

.education-booking-show-payment-approved {
    background: rgba(111, 128, 104, .09);
    color: #5e7058;
}

.education-booking-show-payment-pending i,
.education-booking-show-payment-approved i {
    margin-top: 3px;
    font-size: 18px;
}

.education-booking-show-payment-pending strong,
.education-booking-show-payment-approved strong {
    display: block;
    margin-bottom: 3px;
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 13px;
}

.education-booking-show-payment-pending p,
.education-booking-show-payment-approved p {
    margin: 0;
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    line-height: 1.8;
}


/*
|--------------------------------------------------------------------------
| BANK PAYMENT
|--------------------------------------------------------------------------
*/

.education-bank-payment-card {
    margin-bottom: 20px;
    border-radius: 18px;
    background: #faf8f2;
    border: 1px solid rgba(185, 149, 82, .15);
    overflow: hidden;
    cursor: pointer;
}

.education-bank-payment-front {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 19px;
}

.education-bank-payment-icon {
    width: 48px;
    height: 48px;
    flex: 0 0 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: rgba(185, 149, 82, .11);
    color: #b99552;
}

.education-bank-payment-front-content {
    flex: 1;
}

.education-bank-payment-eyebrow {
    display: block;
    margin-bottom: 2px;
    color: #a27f43;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    font-weight: 800;
}

.education-bank-payment-front h3 {
    margin: 0;
    color: #403b32;
    font-family: 'Amiri', serif;
    font-size: 21px;
}

.education-bank-payment-front p {
    margin: 2px 0 0;
    color: #8b8375;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
}

.education-bank-payment-arrow {
    color: #8b8375;
    transition: .25s ease;
}

.education-bank-payment-card.is-open .education-bank-payment-arrow {
    transform: rotate(180deg);
}

.education-bank-payment-details {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows .3s ease;
}

.education-bank-payment-card.is-open .education-bank-payment-details {
    grid-template-rows: 1fr;
}

.education-bank-payment-details-inner {
    overflow: hidden;
    padding: 0 19px;
    transition: padding .3s ease;
}

.education-bank-payment-card.is-open .education-bank-payment-details-inner {
    padding: 0 19px 20px;
}

.education-bank-payment-description {
    display: flex;
    gap: 9px;
    margin-bottom: 15px;
    padding: 13px;
    border-radius: 12px;
    background: rgba(185, 149, 82, .06);
}

.education-bank-payment-description i {
    color: #b99552;
    margin-top: 4px;
}

.education-bank-payment-description p {
    margin: 0;
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    line-height: 1.9;
}

.education-bank-payment-field {
    padding: 13px 0;
    border-bottom: 1px solid rgba(64, 59, 50, .06);
}

.education-bank-payment-field > span {
    display: block;
    margin-bottom: 5px;
    color: #8b8375;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
}

.education-bank-payment-field strong {
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 13px;
}

.education-bank-payment-copy-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.education-bank-payment-copy {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 10px;
    border: 0;
    border-radius: 9px;
    background: rgba(111, 128, 104, .10);
    color: #60735a;
    cursor: pointer;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    font-weight: 700;
}

.education-bank-payment-copy.copied {
    background: rgba(111, 128, 104, .18);
}

.education-bank-payment-iban {
    direction: ltr;
    text-align: left;
}

.education-bank-payment-amount {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-top: 15px;
    padding: 15px;
    border-radius: 13px;
    background: #f5efe1;
}

.education-bank-payment-amount span {
    display: block;
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 12px;
    font-weight: 800;
}

.education-bank-payment-amount small {
    color: #8b8375;
    font-family: 'Cairo', sans-serif;
    font-size: 9px;
}

.education-bank-payment-amount strong {
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 17px;
}

.education-bank-payment-instructions {
    margin-top: 15px;
    padding: 14px;
    border-radius: 13px;
    background: rgba(111, 128, 104, .07);
}

.education-bank-payment-instructions-title {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 6px;
    color: #60735a;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 800;
}

.education-bank-payment-instructions p {
    margin: 0;
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    line-height: 1.9;
}

.education-bank-payment-copy-success {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-top: 12px;
    color: #5e7058;
    opacity: 0;
    transform: translateY(4px);
    transition: .2s ease;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
}

.education-bank-payment-copy-success.show {
    opacity: 1;
    transform: translateY(0);
}


/*
|--------------------------------------------------------------------------
| NOTES
|--------------------------------------------------------------------------
*/

.education-booking-show-note {
    margin-top: 18px;
    padding: 17px;
    border-radius: 15px;
    background: #faf8f2;
    border: 1px solid rgba(64, 59, 50, .06);
}

.education-booking-show-note-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 7px;
    color: #b99552;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 800;
}

.education-booking-show-note p {
    margin: 0;
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 12px;
    line-height: 1.9;
}


/*
|--------------------------------------------------------------------------
| STUDENT LESSON CONTENT
|--------------------------------------------------------------------------
*/

.education-booking-show-completed-lesson {
    position: relative;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    margin-top: 22px;
    padding: 21px;
    border-radius: 18px;
    background: linear-gradient(
        135deg,
        #fffdf8,
        #f5efe1
    );
    border: 1px solid rgba(185, 149, 82, .17);
}

.education-booking-show-completed-lesson-icon {
    flex: 0 0 52px;
    width: 52px;
    height: 52px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    background: rgba(111, 128, 104, .12);
    color: #6f8068;
    font-size: 21px;
}

.education-booking-show-completed-lesson-content {
    flex: 1;
}

.education-booking-show-completed-lesson-label {
    display: block;
    margin-bottom: 3px;
    color: #b99552;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    font-weight: 800;
}

.education-booking-show-completed-lesson-content h3 {
    margin: 0 0 5px;
    color: #403b32;
    font-family: 'Amiri', serif;
    font-size: 23px;
}

.education-booking-show-completed-lesson-content p {
    margin: 0 0 15px;
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    line-height: 1.8;
}

.education-booking-show-completed-lesson-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 9px;
}

.education-booking-show-completed-lesson-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 15px;
    border-radius: 11px;
    background: #6f8068;
    color: #fff;
    text-decoration: none;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    font-weight: 700;
    transition: .25s ease;
}

.education-booking-show-completed-lesson-button:hover {
    background: #5e7058;
    color: #fff;
    transform: translateY(-1px);
}

.education-booking-show-completed-lesson-button i:last-child {
    transition: .25s ease;
}

.education-booking-show-completed-lesson-button:hover i:last-child {
    transform: translateX(-3px);
}

.education-booking-show-no-lesson {
    padding: 12px 14px;
    border-radius: 11px;
    background: rgba(185, 149, 82, .07);
    color: #756e61;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    line-height: 1.8;
}

.education-booking-show-no-lesson i {
    margin-left: 5px;
    color: #b99552;
}


/*
|--------------------------------------------------------------------------
| LESSON LOCKED
|--------------------------------------------------------------------------
*/

.education-booking-show-lesson-locked {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border-radius: 11px;
    background: rgba(185, 149, 82, .08);
    border: 1px solid rgba(185, 149, 82, .12);
    color: #8b7040;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    line-height: 1.8;
}

.education-booking-show-lesson-locked i {
    color: #b99552;
    font-size: 14px;
}


/*
|--------------------------------------------------------------------------
| SUMMARY
|--------------------------------------------------------------------------
*/

.education-booking-show-summary {
    position: sticky;
    top: 25px;
}

.education-booking-show-summary-list {
    display: flex;
    flex-direction: column;
}

.education-booking-show-summary-item {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 13px 0;
    border-bottom: 1px solid rgba(64, 59, 50, .06);
}

.education-booking-show-summary-item:last-child {
    border-bottom: 0;
}

.education-booking-show-summary-icon {
    flex: 0 0 37px;
    width: 37px;
    height: 37px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: rgba(185, 149, 82, .08);
    color: #b99552;
    font-size: 13px;
}

.education-booking-show-summary-text {
    min-width: 0;
}

.education-booking-show-summary-text span {
    display: block;
    margin-bottom: 2px;
    color: #8b8375;
    font-family: 'Cairo', sans-serif;
    font-size: 9px;
}

.education-booking-show-summary-text strong {
    display: block;
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    line-height: 1.6;
}


/*
|--------------------------------------------------------------------------
| ACTIONS
|--------------------------------------------------------------------------
*/

.education-booking-show-actions {
    display: flex;
    flex-direction: column;
    gap: 9px;
    margin-top: 20px;
}

.education-booking-show-action {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 43px;
    border-radius: 11px;
    text-decoration: none;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 800;
}

.education-booking-show-action.secondary {
    background: rgba(111, 128, 104, .09);
    color: #60735a;
}

.education-booking-show-action.primary {
    background: #6f8068;
    color: #fff;
}

.education-booking-show-action.primary:hover {
    background: #5e7058;
    color: #fff;
}

.education-booking-show-action.secondary:hover {
    background: rgba(111, 128, 104, .16);
    color: #60735a;
}

.education-booking-show-cancel {
    width: 100%;
    min-height: 43px;
    border: 1px solid rgba(170, 75, 75, .15);
    border-radius: 11px;
    background: rgba(170, 75, 75, .06);
    color: #a04d4d;
    cursor: pointer;
    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 800;
}

.education-booking-show-cancel:hover {
    background: rgba(170, 75, 75, .11);
}


/*
|--------------------------------------------------------------------------
| SESSION SUMMARY
|--------------------------------------------------------------------------
*/

.education-booking-show-session-summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-top: 18px;
}

.education-booking-show-session-box {
    padding: 13px;
    text-align: center;
    border-radius: 13px;
    background: #faf8f2;
    border: 1px solid rgba(64, 59, 50, .06);
}

.education-booking-show-session-box strong {
    display: block;
    margin-bottom: 3px;
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 18px;
}

.education-booking-show-session-box span {
    color: #8b8375;
    font-family: 'Cairo', sans-serif;
    font-size: 9px;
}


/*
|--------------------------------------------------------------------------
| TIMELINE
|--------------------------------------------------------------------------
*/

.education-booking-show-timeline-card {
    margin-top: 22px;
}

.education-booking-show-timeline-list {
    position: relative;
}

.education-booking-show-timeline-item {
    position: relative;
    display: flex;
    gap: 14px;
    padding-bottom: 20px;
}

.education-booking-show-timeline-item:last-child {
    padding-bottom: 0;
}

.education-booking-show-timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    top: 9px;
    right: 5px;
    width: 1px;
    height: calc(100% - 3px);
    background: rgba(185, 149, 82, .20);
}

.education-booking-show-timeline-dot {
    position: relative;
    z-index: 1;
    flex: 0 0 11px;
    width: 11px;
    height: 11px;
    margin-top: 4px;
    border-radius: 50%;
    background: #b99552;
    box-shadow: 0 0 0 5px rgba(185, 149, 82, .08);
}

.education-booking-show-timeline-content strong {
    display: block;
    margin-bottom: 3px;
    color: #403b32;
    font-family: 'Cairo', sans-serif;
    font-size: 12px;
}

.education-booking-show-timeline-content span {
    display: block;
    color: #8b8375;
    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    line-height: 1.8;
}


/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media (max-width: 900px) {

    .education-booking-show-grid {
        grid-template-columns: 1fr;
    }

    .education-booking-show-summary {
        position: static;
    }
}

@media (max-width: 600px) {

    .education-booking-show-container {
        width: min(100% - 22px, 1180px);
        padding-top: 22px;
    }

    .education-booking-show-header h1 {
        font-size: 31px;
    }

    .education-booking-show-hero {
        align-items: flex-start;
        padding: 22px;
    }

    .education-booking-show-hero h2 {
        font-size: 25px;
    }

    .education-booking-show-hero-icon {
        flex-basis: 55px;
        width: 55px;
        height: 55px;
        font-size: 22px;
    }

    .education-booking-show-card {
        padding: 19px;
    }

    .education-booking-show-details {
        grid-template-columns: 1fr;
    }

    .education-booking-show-payment-action {
        flex-direction: column;
        align-items: stretch;
    }

    .education-booking-show-payment-button {
        width: 100%;
    }

    .education-booking-show-completed-lesson {
        flex-direction: column;
    }

    .education-booking-show-session-summary {
        grid-template-columns: 1fr;
    }

    .education-bank-payment-copy-row {
        align-items: flex-start;
        flex-direction: column;
    }

    .education-bank-payment-copy {
        width: 100%;
        justify-content: center;
    }
}

</style>


<div class="education-booking-show">

    <div class="education-booking-show-container">


        {{-- ==================================================
            TOP NAVIGATION
        ================================================== --}}

        <div class="education-booking-show-topbar">

            <a
                href="{{ route('education.dashboard') }}"
                class="education-booking-show-back"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education.booking_show_page.navigation.back_to_dashboard') }}

            </a>

        </div>


        {{-- ==================================================
            PAGE HEADER
        ================================================== --}}

        <header class="education-booking-show-header">

            <span class="education-booking-show-eyebrow">
                {{ __('education.booking_show_page.header.eyebrow') }}
            </span>

            <h1>
                {{ __('education.booking_show_page.header.title') }}
            </h1>

            <p>
                {{ __('education.booking_show_page.header.description') }}
            </p>

        </header>


        {{-- ==================================================
            ALERTS
        ================================================== --}}

        @if(session('success'))

            <div class="education-booking-show-alert">

                <i class="fa-solid fa-circle-check"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif


        @if(session('booking_success'))

            <div class="education-booking-show-alert">

                <i class="fa-solid fa-circle-check"></i>

                <span>
                    {{ session('booking_success') }}
                </span>

            </div>

        @endif


        @if(session('error'))

            <div class="education-booking-show-alert education-booking-show-alert-danger">

                <i class="fa-solid fa-circle-exclamation"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>

        @endif


        {{-- ==================================================
            STATUS HERO
        ================================================== --}}

        <section class="education-booking-show-hero">

            <div class="education-booking-show-hero-content">

                <span class="education-booking-show-hero-label">
                    {{ $statusLabel }}
                </span>

                <h2>
                    {{ $booking->title ?? $bookingTypeTitle }}
                </h2>

                <p>

                    @if($booking->status === 'confirmed')

                        {{ __('education.booking_show_page.status_messages.confirmed') }}

                    @elseif($booking->status === 'pending')

                        {{ __('education.booking_show_page.status_messages.pending') }}

                    @elseif($booking->status === 'completed')

                        {{ __('education.booking_show_page.status_messages.completed') }}

                    @elseif($booking->status === 'cancelled')

                        {{ __('education.booking_show_page.status_messages.cancelled') }}

                    @elseif($booking->status === 'rejected')

                        {{ __('education.booking_show_page.status_messages.rejected') }}

                    @elseif($booking->status === 'no_show')

                        {{ __('education.booking_show_page.status_messages.no_show') }}

                    @else

                        {{ __('education.booking_show_page.status_messages.current', ['status' => $booking->status]) }}
                        {{ $booking->status }}

                    @endif

                </p>

            </div>


            <div class="education-booking-show-hero-icon">

                <i class="{{ $statusIcon }}"></i>

            </div>

        </section>


        {{-- ==================================================
            MAIN GRID
        ================================================== --}}

        <div class="education-booking-show-grid">


            {{-- ==================================================
                MAIN DETAILS
            ================================================== --}}

            <section class="education-booking-show-card">

                <div class="education-booking-show-card-header">

                    <div>

                        <span class="education-booking-show-card-header-label">
                            {{ __('education.booking_show_page.booking_info.label') }}
                        </span>

                        <h3>
                            {{ __('education.booking_show_page.booking_info.title') }}
                        </h3>

                    </div>

                    <div class="education-booking-show-card-icon">

                        <i class="fa-regular fa-calendar-days"></i>

                    </div>

                </div>


                {{-- STATUS --}}

                <div style="margin-bottom: 18px;">

                    <span class="education-booking-show-status {{ $booking->status }}">

                        <i class="{{ $statusIcon }}"></i>

                        {{ $statusLabel }}

                    </span>

                </div>


                {{-- BOOKING TYPE --}}

                <div class="education-booking-show-lesson">

                    <div class="education-booking-show-lesson-icon">

                        @if($category === 'quran')

                            <i class="fa-solid fa-book-quran"></i>

                        @elseif($category === 'tajweed')

                            <i class="fa-solid fa-microphone-lines"></i>

                        @elseif($category === 'arabic')

                            <i class="fa-solid fa-language"></i>

                        @else

                            <i class="fa-solid fa-book-open"></i>

                        @endif

                    </div>


                    <div class="education-booking-show-lesson-content">

                        <span class="education-booking-show-lesson-category">

                            {{ $bookingTypeTitle }}

                        </span>

                        <h4>
                            {{ $booking->title ?? $bookingTypeTitle }}
                        </h4>

                        @if($booking->description)

                            <p>
                                {{ $booking->description }}
                            </p>

                        @endif

                    </div>

                </div>


                {{-- DATE / TIME / ID --}}

                <div class="education-booking-show-details">


                    <div class="education-booking-show-detail">

                        <span class="education-booking-show-detail-label">
                            {{ __('education.booking_show_page.booking_info.date') }}
                        </span>

                        <div class="education-booking-show-detail-value">

                            <i class="fa-regular fa-calendar"></i>

                            <span>

                                @if($bookingDate)

                                    {{ $bookingDate->translatedFormat('l، d F Y') }}

                                @else

                                    {{ __('education.booking_show_page.booking_info.not_specified') }}

                                @endif

                            </span>

                        </div>

                    </div>


                    <div class="education-booking-show-detail">

                        <span class="education-booking-show-detail-label">
                            {{ __('education.booking_show_page.booking_info.time') }}
                        </span>

                        <div class="education-booking-show-detail-value">

                            <i class="fa-regular fa-clock"></i>

                            <span>

                                @if($booking->start_time)

                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}

                                @else

                                    --

                                @endif

                                -

                                @if($booking->end_time)

                                    {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}

                                @else

                                    --

                                @endif

                            </span>

                        </div>

                    </div>


                    <div class="education-booking-show-detail">

                        <span class="education-booking-show-detail-label">
                            {{ __('education.booking_show_page.booking_info.number') }}
                        </span>

                        <div class="education-booking-show-detail-value">

                            <i class="fa-solid fa-hashtag"></i>

                            <span>
                                {{ $booking->id }}
                            </span>

                        </div>

                    </div>


                    <div class="education-booking-show-detail">

                        <span class="education-booking-show-detail-label">
                            {{ __('education.booking_show_page.booking_info.created_at') }}
                        </span>

                        <div class="education-booking-show-detail-value">

                            <i class="fa-regular fa-calendar-plus"></i>

                            <span>

                                @if($booking->created_at)

                                    {{ $booking->created_at->translatedFormat('d F Y') }}

                                @else

                                    --

                                @endif

                            </span>

                        </div>

                    </div>

                </div>


                {{-- ==================================================
                    SESSIONS
                ================================================== --}}

                <div class="education-booking-show-session-summary">

                    <div class="education-booking-show-session-box">

                        <strong>
                            {{ $totalSessions }}
                        </strong>

                        <span>
                            {{ __('education.booking_show_page.sessions.total') }}
                        </span>

                    </div>


                    <div class="education-booking-show-session-box">

                        <strong>
                            {{ $completedSessions }}
                        </strong>

                        <span>
                            {{ __('education.booking_show_page.sessions.completed') }}
                        </span>

                    </div>


                    <div class="education-booking-show-session-box">

                        <strong>
                            {{ $remainingSessions }}
                        </strong>

                        <span>
                            {{ __('education.booking_show_page.sessions.remaining') }}
                        </span>

                    </div>

                </div>


                {{-- ==================================================
                    PRICE
                ================================================== --}}

                <div class="education-booking-show-price">

                    <div>

                        <span class="education-booking-show-price-label">
                            {{ __('education.booking_show_page.bank_transfer.booking_value') }}
                        </span>

                    </div>

                    <div class="education-booking-show-price-value">

                        {{ number_format((float) ($booking->price ?? 0), 2) }}

                        <span class="education-booking-show-price-currency">
                            {{ $booking->currency ?? 'SAR' }}
                        </span>

                    </div>

                </div>


                {{-- ==================================================
                    PAYMENT STATUS
                ================================================== --}}

                <div class="education-booking-show-payment">

                    <div class="education-booking-show-payment-status">

                        <div>

                            <span class="education-booking-show-payment-label">
                                {{ __('education.booking_show_page.payment.status') }}
                            </span>

                            <span class="education-booking-show-payment-value">
                                {{ $paymentLabel }}
                            </span>

                        </div>


                        <span class="education-booking-show-payment-badge">
                            {{ $paymentLabel }}
                        </span>

                    </div>


                    @if($payment)

                        @if($payment->payment_method)

                            <div class="education-booking-show-payment-meta">

                                <span>
                                    {{ __('education.booking_show_page.payment.method') }}
                                </span>

                                <strong>

                                    @if($payment->payment_method === 'bank_transfer')

                                        {{ __('education.booking_show_page.payment.bank_transfer') }}

                                    @elseif($payment->payment_method === 'cash')

                                        {{ __('education.booking_show_page.payment.cash') }}

                                    @else

                                        {{ $payment->payment_method }}

                                    @endif

                                </strong>

                            </div>

                        @endif


                        @if($payment->payment_reference)

                            <div class="education-booking-show-payment-meta">

                                <span>
                                    {{ __('education.booking_show_page.payment.reference') }}
                                </span>

                                <strong>
                                    {{ $payment->payment_reference }}
                                </strong>

                            </div>

                        @endif


                        @if($payment->submitted_at)

                            <div class="education-booking-show-payment-meta">

                                <span>
                                    {{ __('education.booking_show_page.payment.submitted_at') }}
                                </span>

                                <strong>
                                    {{ $payment->submitted_at->translatedFormat('d F Y - H:i') }}
                                </strong>

                            </div>

                        @endif

                    @endif

                </div>


                {{-- ==================================================
                    PAYMENT ACTION
                ================================================== --}}

                @if(
                    in_array($paymentStatus, [
                        'unpaid',
                        'failed',
                        'rejected'
                    ])
                )

                    @if(
                        $educationSettings &&
                        $educationSettings->payment_enabled &&
                        in_array($booking->status, [
                            'pending',
                            'confirmed'
                        ])
                    )

                        <div class="education-booking-show-payment-action">

                            <div>

                                <strong>
                                    {{ __('education.booking_show_page.payment_action.question') }}
                                </strong>

                                <p>
                                    {{ __('education.booking_show_page.payment_action.description') }}
                                </p>

                            </div>


                            <a
                                href="{{ route(
                                    'education.booking.payment.show',
                                    $booking
                                ) }}"
                                class="education-booking-show-payment-button"
                            >

                                <i class="fa-solid fa-cloud-arrow-up"></i>

                                @if($paymentStatus === 'rejected')

                                    {{ __('education.booking_show_page.payment_action.resend_proof') }}

                                @else

                                    {{ __('education.booking_show_page.payment_action.send_proof') }}

                                @endif

                            </a>

                        </div>

                    @endif

                @elseif(
                    in_array($paymentStatus, [
                        'submitted',
                        'under_review'
                    ])
                )

                    <div class="education-booking-show-payment-pending">

                        <i class="fa-solid fa-hourglass-half"></i>

                        <div>

                            <strong>
                                {{ __('education.booking_show_page.payment_messages.pending_title') }}
                            </strong>

                            <p>
                                {{ __('education.booking_show_page.payment_messages.pending_description') }}
                            </p>

                        </div>

                    </div>

                @elseif($paymentStatus === 'approved')

                    <div class="education-booking-show-payment-approved">

                        <i class="fa-solid fa-circle-check"></i>

                        <div>

                            <strong>
                                {{ __('education.booking_show_page.timeline.payment_approved') }}
                            </strong>

                            <p>
                                {{ __('education.booking_show_page.payment_messages.approved_description') }}
                            </p>

                        </div>

                    </div>

                @endif


                {{-- ==================================================
                    BANK TRANSFER
                ================================================== --}}

                @if(
                    $educationSettings &&
                    $educationSettings->payment_enabled &&
                    in_array($booking->status, [
                        'pending',
                        'confirmed'
                    ]) &&
                    $paymentStatus !== 'approved'
                )

                    <div
                        class="education-bank-payment-card"
                        tabindex="0"
                        role="button"
                        aria-expanded="false"
                    >

                        <div class="education-bank-payment-front">

                            <div class="education-bank-payment-icon">

                                <i class="fa-solid fa-building-columns"></i>

                            </div>


                            <div class="education-bank-payment-front-content">

                                <span class="education-bank-payment-eyebrow">
                                    {{ __('education.booking_show_page.payment.method') }}
                                </span>

                                <h3>
                                    {{ __('education.booking_show_page.bank_transfer.title') }}
                                </h3>

                                @if($educationSettings->bank_name)

                                    <p>
                                        {{ $educationSettings->bank_name }}
                                    </p>

                                @endif

                            </div>


                            <div class="education-bank-payment-arrow">

                                <i class="fa-solid fa-chevron-down"></i>

                            </div>

                        </div>


                        <div class="education-bank-payment-details">

                            <div class="education-bank-payment-details-inner">

                                <div class="education-bank-payment-description">

                                    <i class="fa-solid fa-circle-info"></i>

                                    <p>
                                        {{ __('education.booking_show_page.bank_transfer.description') }}
                                    </p>

                                </div>


                                @if($educationSettings->account_name)

                                    <div class="education-bank-payment-field">

                                        <span>
                                            {{ __('education.booking_show_page.bank_transfer.account_name') }}
                                        </span>

                                        <strong>
                                            {{ $educationSettings->account_name }}
                                        </strong>

                                    </div>

                                @endif


                                @if($educationSettings->account_number)

                                    <div class="education-bank-payment-field">

                                        <span>
                                            {{ __('education.booking_show_page.bank_transfer.account_number') }}
                                        </span>

                                        <div class="education-bank-payment-copy-row">

                                            <strong>
                                                {{ $educationSettings->account_number }}
                                            </strong>

                                            <button
                                                type="button"
                                                class="education-bank-payment-copy"
                                                data-copy="{{ $educationSettings->account_number }}"
                                            >

                                                <i class="fa-regular fa-copy"></i>

                                                <span>
                                                    {{ __('education.booking_show_page.bank_transfer.copy') }}
                                                </span>

                                            </button>

                                        </div>

                                    </div>

                                @endif


                                @if($educationSettings->iban)

                                    <div class="education-bank-payment-field">

                                        <span>
                                            IBAN
                                        </span>

                                        <div class="education-bank-payment-copy-row">

                                            <strong class="education-bank-payment-iban">
                                                {{ $educationSettings->iban }}
                                            </strong>

                                            <button
                                                type="button"
                                                class="education-bank-payment-copy"
                                                data-copy="{{ $educationSettings->iban }}"
                                            >

                                                <i class="fa-regular fa-copy"></i>

                                                <span>
                                                    {{ __('education.booking_show_page.bank_transfer.copy') }}
                                                </span>

                                            </button>

                                        </div>

                                    </div>

                                @endif


                                <div class="education-bank-payment-amount">

                                    <div>

                                        <span>
                                            {{ __('education.booking_show_page.bank_transfer.amount') }}
                                        </span>

                                        <small>
                                            {{ __('education.booking_show_page.bank_transfer.booking_value') }}
                                        </small>

                                    </div>

                                    <strong>

                                        {{ number_format((float) ($booking->price ?? 0), 2) }}

                                        {{ $booking->currency ?? 'SAR' }}

                                    </strong>

                                </div>


                                @if($educationSettings->payment_instructions)

                                    <div class="education-bank-payment-instructions">

                                        <div class="education-bank-payment-instructions-title">

                                            <i class="fa-solid fa-circle-info"></i>

                                            <span>
                                                {{ __('education.booking_show_page.bank_transfer.instructions') }}
                                            </span>

                                        </div>

                                        <p>
                                            {{ $educationSettings->payment_instructions }}
                                        </p>

                                    </div>

                                @endif


                                <div
                                    class="education-bank-payment-copy-success"
                                    aria-live="polite"
                                >

                                    <i class="fa-solid fa-circle-check"></i>

                                    <span>
                                        {{ __('education.booking_show_page.bank_transfer.copied_successfully') }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- ==================================================
                    STUDENT NOTE
                ================================================== --}}

                @if($booking->student_note)

                    <div class="education-booking-show-note">

                        <div class="education-booking-show-note-header">

                            <i class="fa-regular fa-message"></i>

                            <span>
                                {{ __('education.booking_show_page.notes.student') }}
                            </span>

                        </div>

                        <p>
                            {{ $booking->student_note }}
                        </p>

                    </div>

                @endif


                {{-- ==================================================
                    ADMIN NOTE
                ================================================== --}}

                @if($booking->admin_note)

                    <div class="education-booking-show-note">

                        <div class="education-booking-show-note-header">

                            <i class="fa-solid fa-circle-info"></i>

                            <span>
                                {{ __('education.booking_show_page.notes.admin') }}
                            </span>

                        </div>

                        <p>
                            {{ $booking->admin_note }}
                        </p>

                    </div>

                @endif


                {{-- ==================================================
                    STUDENT LESSON CONTENT
                ================================================== --}}

                @if($activeLessons->isNotEmpty())

                    <div class="education-booking-show-completed-lesson">

                        <div class="education-booking-show-completed-lesson-icon">

                            @if($lessonsAvailable)

                                <i class="fa-solid fa-book-open-reader"></i>

                            @else

                                <i class="fa-solid fa-lock"></i>

                            @endif

                        </div>


                        <div class="education-booking-show-completed-lesson-content">

                            @if($lessonsAvailable)

                                <span class="education-booking-show-completed-lesson-label">
                                    {{ __('education.booking_show_page.summary.lesson_content') }}
                                </span>

                                <h3>
                                    {{ __('education.booking_show_page.lesson_content.available_title') }}
                                </h3>

                                <p>
                                    {{ __('education.booking_show_page.lesson_content.available_description') }}
                                </p>


                                <div class="education-booking-show-completed-lesson-buttons">

                                    <a
                                        href="{{ route('education.student.lessons.index') }}"
                                        class="education-booking-show-completed-lesson-button"
                                    >

                                        <i class="fa-solid fa-book-open"></i>

                                        <span>
                                            {{ __('education.booking_show_page.lesson_content.open') }}
                                        </span>

                                        <i class="fa-solid fa-arrow-left"></i>

                                    </a>

                                </div>

                            @else

                                <span class="education-booking-show-completed-lesson-label">
                                    {{ __('education.booking_show_page.summary.lesson_content') }}
                                </span>

                                <h3>
                                    {{ __('education.booking_show_page.lesson_content.assigned_title') }}
                                </h3>

                                <p>
                                    {{ __('education.booking_show_page.lesson_content.assigned_description') }}
                                </p>


                                <div class="education-booking-show-lesson-locked">

                                    <i class="fa-solid fa-lock"></i>

                                    <span>
                                        {{ __('education.booking_show_page.lesson_content.locked') }}
                                    </span>

                                </div>

                            @endif

                        </div>

                    </div>

                @endif

            </section>


            {{-- ==================================================
                SIDE SUMMARY
            ================================================== --}}

            <aside class="education-booking-show-card education-booking-show-summary">

                <div class="education-booking-show-card-header">

                    <div>

                        <span class="education-booking-show-card-header-label">
                            {{ __('education.booking_show_page.summary.label') }}
                        </span>

                        <h3>
                            {{ __('education.booking_show_page.summary.title') }}
                        </h3>

                    </div>

                    <div class="education-booking-show-card-icon">

                        <i class="fa-solid fa-list-check"></i>

                    </div>

                </div>


                <div class="education-booking-show-summary-list">


                    <div class="education-booking-show-summary-item">

                        <div class="education-booking-show-summary-icon">

                            <i class="fa-solid fa-book-open"></i>

                        </div>

                        <div class="education-booking-show-summary-text">

                            <span>
                                {{ __('education.booking_show_page.summary.booking_type') }}
                            </span>

                            <strong>
                                {{ $bookingTypeTitle }}
                            </strong>

                        </div>

                    </div>


                    <div class="education-booking-show-summary-item">

                        <div class="education-booking-show-summary-icon">

                            <i class="fa-regular fa-calendar"></i>

                        </div>

                        <div class="education-booking-show-summary-text">

                            <span>
                                {{ __('education.booking_show_page.summary.date') }}
                            </span>

                            <strong>

                                @if($bookingDate)

                                    {{ $bookingDate->translatedFormat('d F Y') }}

                                @else

                                    {{ __('education.booking_show_page.booking_info.not_specified') }}

                                @endif

                            </strong>

                        </div>

                    </div>


                    <div class="education-booking-show-summary-item">

                        <div class="education-booking-show-summary-icon">

                            <i class="fa-regular fa-clock"></i>

                        </div>

                        <div class="education-booking-show-summary-text">

                            <span>
                                {{ __('education.booking_show_page.summary.time') }}
                            </span>

                            <strong>

                                @if($booking->start_time)

                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }}

                                @else

                                    --

                                @endif

                                -

                                @if($booking->end_time)

                                    {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}

                                @else

                                    --

                                @endif

                            </strong>

                        </div>

                    </div>


                    <div class="education-booking-show-summary-item">

                        <div class="education-booking-show-summary-icon">

                            <i class="fa-solid fa-coins"></i>

                        </div>

                        <div class="education-booking-show-summary-text">

                            <span>
                                {{ __('education.booking_show_page.summary.price') }}
                            </span>

                            <strong>

                                {{ number_format((float) ($booking->price ?? 0), 2) }}

                                {{ $booking->currency ?? 'SAR' }}

                            </strong>

                        </div>

                    </div>


                    <div class="education-booking-show-summary-item">

                        <div class="education-booking-show-summary-icon">

                            <i class="fa-solid fa-credit-card"></i>

                        </div>

                        <div class="education-booking-show-summary-text">

                            <span>
                                {{ __('education.booking_show_page.summary.payment') }}
                            </span>

                            <strong>
                                {{ $paymentLabel }}
                            </strong>

                        </div>

                    </div>


                    <div class="education-booking-show-summary-item">

                        <div class="education-booking-show-summary-icon">

                            <i class="fa-solid fa-circle-info"></i>

                        </div>

                        <div class="education-booking-show-summary-text">

                            <span>
                                {{ __('education.booking_show_page.summary.status') }}
                            </span>

                            <strong>
                                {{ $statusLabel }}
                            </strong>

                        </div>

                    </div>


                    {{-- LESSON AVAILABILITY --}}

                    @if($activeLessons->isNotEmpty())

                        <div class="education-booking-show-summary-item">

                            <div class="education-booking-show-summary-icon">

                                <i class="fa-solid {{ $lessonsAvailable ? 'fa-book-open' : 'fa-lock' }}"></i>

                            </div>

                            <div class="education-booking-show-summary-text">

                                <span>
                                    {{ __('education.booking_show_page.summary.lesson_content') }}
                                </span>

                                <strong>

                                    @if($lessonsAvailable)

                                        {{ __('education.booking_show_page.lesson_content.available_now') }}

                                    @else

                                        {{ __('education.booking_show_page.lesson_content.not_available_yet') }}

                                    @endif

                                </strong>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- ACTIONS --}}

                <div class="education-booking-show-actions">

                    <a
                        href="{{ route('education.dashboard') }}"
                        class="education-booking-show-action secondary"
                    >

                        <i class="fa-solid fa-arrow-right"></i>

                        {{ __('education.booking_show_page.actions.dashboard') }}

                    </a>


                    <a
                        href="{{ route('education.booking.create') }}"
                        class="education-booking-show-action primary"
                    >

                        <i class="fa-regular fa-calendar-plus"></i>

                        {{ __('education.booking_show_page.actions.new_booking') }}

                    </a>

                </div>


                {{-- LESSON CONTENT BUTTON --}}

                @if($lessonsAvailable)

                    <a
                        href="{{ route('education.student.lessons.index') }}"
                        class="education-booking-show-action primary"
                        style="margin-top: 10px;"
                    >

                        <i class="fa-solid fa-book-open-reader"></i>

                        {{ __('education.booking_show_page.summary.lesson_content') }}

                    </a>

                @endif


                {{-- PAYMENT BUTTON --}}

                @if(
                    in_array($paymentStatus, [
                        'unpaid',
                        'failed',
                        'rejected'
                    ]) &&
                    $educationSettings &&
                    $educationSettings->payment_enabled &&
                    in_array($booking->status, [
                        'pending',
                        'confirmed'
                    ])
                )

                    <a
                        href="{{ route(
                            'education.booking.payment.show',
                            $booking
                        ) }}"
                        class="education-booking-show-action primary"
                        style="margin-top: 10px;"
                    >

                        <i class="fa-solid fa-credit-card"></i>

                        @if($paymentStatus === 'rejected')

                            {{ __('education.booking_show_page.actions.resubmit_payment') }}

                        @else

                            {{ __('education.booking_show_page.actions.pay_booking') }}

                        @endif

                    </a>

                @endif


                {{-- CANCELLATION --}}

                @if(
                    in_array($booking->status, [
                        'pending',
                        'confirmed'
                    ]) &&
                    $bookingDate &&
                    $bookingDate->isFuture()
                )

                    <form
                        method="POST"
                        action="{{ route(
                            'education.booking.cancel',
                            $booking
                        ) }}"
                        onsubmit="return confirm('{{ __('education.booking_show_page.actions.confirm_cancel') }}');"
                        style="margin-top: 10px;"
                    >

                        @csrf

                        @method('PATCH')

                        <button
                            type="submit"
                            class="education-booking-show-cancel"
                        >

                            <i class="fa-solid fa-calendar-xmark"></i>

                            {{ __('education.booking_show_page.actions.cancel_booking') }}

                        </button>

                    </form>

                @endif

            </aside>

        </div>


        {{-- ==================================================
            BOOKING TIMELINE
        ================================================== --}}

        <section class="education-booking-show-card education-booking-show-timeline-card">

            <div class="education-booking-show-card-header">

                <div>

                    <span class="education-booking-show-card-header-label">
                        {{ __('education.booking_show_page.timeline.label') }}
                    </span>

                    <h3>
                        {{ __('education.booking_show_page.timeline.title') }}
                    </h3>

                </div>

                <div class="education-booking-show-card-icon">

                    <i class="fa-solid fa-route"></i>

                </div>

            </div>


            <div class="education-booking-show-timeline-list">


                <div class="education-booking-show-timeline-item">

                    <div class="education-booking-show-timeline-dot"></div>

                    <div class="education-booking-show-timeline-content">

                        <strong>
                            {{ __('education.booking_show_page.timeline.booking_submitted') }}
                        </strong>

                        <span>

                            @if($booking->created_at)

                                {{ $booking->created_at->translatedFormat('l، d F Y - H:i') }}

                            @else

                                --

                            @endif

                        </span>

                    </div>

                </div>


                @if(
                    in_array($booking->status, [
                        'pending',
                        'confirmed',
                        'completed',
                        'cancelled',
                        'rejected'
                    ])
                )

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.booking_reviewed') }}
                            </strong>

                            <span>
                                {{ __('education.booking_show_page.timeline.booking_reviewed_description') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if(
                    in_array($booking->status, [
                        'confirmed',
                        'completed'
                    ])
                )

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.booking_confirmed') }}
                            </strong>

                            <span>
                                {{ __('education.booking_show_page.timeline.booking_confirmed_description') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if(
                    $payment &&
                    in_array($paymentStatus, [
                        'submitted',
                        'under_review',
                        'approved'
                    ])
                )

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.payment_submitted') }}
                            </strong>

                            <span>

                                @if($payment->submitted_at)

                                    {{ $payment->submitted_at->translatedFormat('l، d F Y - H:i') }}

                                @else

                                    {{ __('education.booking_show_page.timeline.payment_submitted_description') }}

                                @endif

                            </span>

                        </div>

                    </div>

                @endif


                @if($paymentStatus === 'approved')

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.payment_approved') }}
                            </strong>

                            <span>
                                {{ __('education.booking_show_page.timeline.payment_approved_description') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if($paymentStatus === 'rejected')

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.payment_rejected') }}
                            </strong>

                            <span>
                                {{ __('education.booking_show_page.timeline.payment_rejected_description') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if($booking->status === 'completed')

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.lesson_completed') }}
                            </strong>

                            <span>
                                {{ __('education.booking_show_page.timeline.lesson_completed_description') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if($booking->status === 'cancelled')

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.booking_cancelled') }}
                            </strong>

                            <span>
                                {{ __('education.booking_show_page.timeline.booking_cancelled_description') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if($booking->status === 'rejected')

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.booking_rejected') }}
                            </strong>

                            <span>
                                {{ __('education.booking_show_page.timeline.booking_rejected_description') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if($booking->status === 'no_show')

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.no_show') }}
                            </strong>

                            <span>
                                {{ __('education.booking_show_page.status_messages.no_show') }}
                            </span>

                        </div>

                    </div>

                @endif


                @if($lessonsAvailable)

                    <div class="education-booking-show-timeline-item">

                        <div class="education-booking-show-timeline-dot"></div>

                        <div class="education-booking-show-timeline-content">

                            <strong>
                                {{ __('education.booking_show_page.timeline.lesson_available') }}
                            </strong>

                            <span>
                                {{ __('education.booking_show_page.timeline.lesson_available_description') }}
                            </span>

                        </div>

                    </div>

                @endif

            </div>

        </section>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | BANK PAYMENT CARD
    |--------------------------------------------------------------------------
    */

    const paymentCard = document.querySelector(
        '.education-bank-payment-card'
    );

    if (paymentCard) {

        const togglePaymentCard = function () {

            const isOpen = paymentCard.classList.contains(
                'is-open'
            );

            paymentCard.classList.toggle(
                'is-open',
                !isOpen
            );

            paymentCard.setAttribute(
                'aria-expanded',
                String(!isOpen)
            );
        };


        paymentCard.addEventListener(
            'click',
            function (event) {

                if (
                    event.target.closest(
                        '.education-bank-payment-copy'
                    )
                ) {
                    return;
                }

                togglePaymentCard();
            }
        );


        paymentCard.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Enter' ||
                    event.key === ' '
                ) {

                    event.preventDefault();

                    togglePaymentCard();
                }
            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | COPY ACCOUNT / IBAN
    |--------------------------------------------------------------------------
    */

    const copyButtons = document.querySelectorAll(
        '.education-bank-payment-copy'
    );


    copyButtons.forEach(function (button) {

        button.addEventListener(
            'click',
            async function (event) {

                event.preventDefault();
                event.stopPropagation();

                const value = button.dataset.copy;

                if (!value) {
                    return;
                }


                const card = button.closest(
                    '.education-bank-payment-card'
                );

                const success = card
                    ? card.querySelector(
                        '.education-bank-payment-copy-success'
                    )
                    : null;


                const originalHTML = button.innerHTML;


                try {

                    if (
                        navigator.clipboard &&
                        window.isSecureContext
                    ) {

                        await navigator.clipboard.writeText(
                            value
                        );

                    } else {

                        const textarea =
                            document.createElement(
                                'textarea'
                            );

                        textarea.value = value;

                        textarea.style.position = 'fixed';
                        textarea.style.left = '-9999px';
                        textarea.style.opacity = '0';

                        document.body.appendChild(
                            textarea
                        );

                        textarea.focus();
                        textarea.select();

                        document.execCommand('copy');

                        textarea.remove();
                    }


                    button.innerHTML = `
                        <i class="fa-solid fa-check"></i>
                        <span>{{ __('education.booking_show_page.bank_transfer.copy_success') }}</span>
                    `;

                    button.classList.add('copied');


                    if (success) {

                        success.classList.add('show');

                        setTimeout(function () {

                            success.classList.remove('show');

                        }, 2200);
                    }


                    setTimeout(function () {

                        button.innerHTML =
                            originalHTML;

                        button.classList.remove(
                            'copied'
                        );

                    }, 1800);


                } catch (error) {

                    console.error(
                        'Copy failed:',
                        error
                    );

                }

            }
        );

    }

});

</script>

@endsection
