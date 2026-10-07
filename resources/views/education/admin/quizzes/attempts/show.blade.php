@extends('education.admin.layouts.app')

@section('title', __('education_admin.quiz_attempt_show.page_title'))

@section('content')

<style>

/*
|--------------------------------------------------------------------------
| EDUCATION ADMIN — QUIZ ATTEMPT SHOW
|--------------------------------------------------------------------------
*/

.education-admin-attempt-page {
    direction: rtl;
    width: 100%;
    padding-bottom: 50px;
}


/*
|--------------------------------------------------------------------------
| PAGE HEADER
|--------------------------------------------------------------------------
*/

.education-admin-attempt-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 25px;

    margin-bottom: 28px;
    padding: 28px 30px;

    border-radius: 24px;

    background:
        linear-gradient(
            135deg,
            #fffdf8 0%,
            #f8f1df 100%
        );

    border: 1px solid rgba(185,149,82,.18);

    box-shadow:
        0 12px 35px rgba(70,58,35,.055);
}


.education-admin-attempt-header-main {
    min-width: 0;
}


.education-admin-attempt-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 12px;

    color: #8b6d39;

    font-family: 'Cairo', sans-serif;
    font-size: 12px;
    font-weight: 700;
}


.education-admin-attempt-eyebrow i {
    color: #b99552;
}


.education-admin-attempt-title-row {
    display: flex;
    align-items: center;
    gap: 15px;
}


.education-admin-attempt-title-icon {
    width: 52px;
    height: 52px;

    flex: 0 0 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 16px;

    background: rgba(111,128,104,.12);

    color: #6f8068;

    font-size: 21px;
}


.education-admin-attempt-title-row h1 {
    margin: 0;

    color: #3f3a31;

    font-family: 'Amiri', serif;
    font-size: 34px;
    font-weight: 700;

    line-height: 1.3;
}


.education-admin-attempt-quiz-name {
    display: flex;
    align-items: center;
    gap: 7px;

    margin-top: 5px;

    color: #756d60;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;
}


.education-admin-attempt-quiz-name i {
    color: #b99552;
}


.education-admin-attempt-description {
    max-width: 750px;

    margin: 15px 0 0;

    color: #7b7468;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;

    line-height: 1.9;
}


.education-admin-attempt-header-action {
    flex: 0 0 auto;
}


.education-admin-attempt-back {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;

    min-height: 45px;

    padding: 0 18px;

    border-radius: 13px;

    background: #fff;

    border: 1px solid rgba(111,128,104,.18);

    color: #65735f;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;
    font-size: 12px;
    font-weight: 700;

    transition: .25s ease;
}


.education-admin-attempt-back:hover {
    background: #6f8068;
    color: #fff;

    transform: translateY(-2px);

    box-shadow:
        0 8px 20px rgba(111,128,104,.16);
}


/*
|--------------------------------------------------------------------------
| ALERT
|--------------------------------------------------------------------------
*/

.education-admin-attempt-alert {
    display: flex;
    align-items: center;
    gap: 13px;

    margin-bottom: 25px;
    padding: 15px 18px;

    border-radius: 15px;

    background: rgba(77,120,83,.08);

    border: 1px solid rgba(77,120,83,.13);

    color: #4d7853;

    font-family: 'Cairo', sans-serif;
}


.education-admin-attempt-alert-icon {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex: 0 0 38px;

    border-radius: 11px;

    background: rgba(77,120,83,.12);

    font-size: 17px;
}


.education-admin-attempt-alert strong {
    display: block;

    font-size: 13px;
}


.education-admin-attempt-alert p {
    margin: 2px 0 0;

    font-size: 12px;
    line-height: 1.7;
}


/*
|--------------------------------------------------------------------------
| MAIN GRID
|--------------------------------------------------------------------------
*/

.education-admin-attempt-grid {
    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        330px;

    gap: 24px;

    align-items: start;
}


.education-admin-attempt-main {
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 22px;
}


.education-admin-attempt-sidebar {
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 18px;

    position: sticky;
    top: 20px;
}


/*
|--------------------------------------------------------------------------
| CARD
|--------------------------------------------------------------------------
*/

.education-admin-attempt-card {
    overflow: hidden;

    border-radius: 22px;

    background: #fff;

    border: 1px solid rgba(120,105,78,.10);

    box-shadow:
        0 8px 30px rgba(70,58,35,.045);
}


.education-admin-attempt-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    padding: 20px 23px;

    border-bottom: 1px solid rgba(120,105,78,.08);
}


.education-admin-attempt-card-heading {
    display: flex;
    align-items: center;
    gap: 12px;
}


.education-admin-attempt-card-icon {
    width: 43px;
    height: 43px;

    flex: 0 0 43px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    background: rgba(185,149,82,.12);

    color: #b99552;

    font-size: 17px;
}


.education-admin-attempt-card-icon.green {
    background: rgba(111,128,104,.11);
    color: #6f8068;
}


.education-admin-attempt-card-heading span {
    display: block;

    margin-bottom: 2px;

    color: #9a9183;

    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    font-weight: 600;
}


.education-admin-attempt-card-heading h2,
.education-admin-attempt-card-heading h3 {
    margin: 0;

    color: #484238;

    font-family: 'Amiri', serif;
    font-size: 22px;
    line-height: 1.3;
}


.education-admin-attempt-card-body {
    padding: 23px;
}


/*
|--------------------------------------------------------------------------
| STATUS BADGES
|--------------------------------------------------------------------------
*/

.education-admin-attempt-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 7px 11px;

    border-radius: 50px;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 700;

    white-space: nowrap;
}


.education-admin-attempt-status.success {
    background: rgba(77,120,83,.10);
    color: #4d7853;
}


.education-admin-attempt-status.danger {
    background: rgba(164,79,70,.09);
    color: #a44f46;
}


.education-admin-attempt-status.warning {
    background: rgba(185,149,82,.12);
    color: #8b6d39;
}


/*
|--------------------------------------------------------------------------
| RESULT
|--------------------------------------------------------------------------
*/

.education-admin-attempt-result {
    display: grid;

    grid-template-columns: 205px minmax(0,1fr);

    gap: 30px;

    align-items: center;

    padding: 27px;
}


/*
|--------------------------------------------------------------------------
| SCORE CIRCLE
|--------------------------------------------------------------------------
*/

.education-admin-attempt-score-wrap {
    display: flex;
    justify-content: center;
}


.education-admin-attempt-score-circle {
    position: relative;

    width: 165px;
    height: 165px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background:
        conic-gradient(
            #6f8068 var(--score),
            #ece5d8 var(--score)
        );

    box-shadow:
        0 15px 35px rgba(70,58,35,.10);
}


.education-admin-attempt-score-circle::before {
    content: '';

    position: absolute;

    inset: 10px;

    border-radius: 50%;

    background: #fffdf8;
}


.education-admin-attempt-score-content {
    position: relative;
    z-index: 2;

    text-align: center;
}


.education-admin-attempt-score-content strong {
    display: block;

    color: #514a3e;

    font-family: 'Cairo', sans-serif;
    font-size: 31px;
    font-weight: 800;
}


.education-admin-attempt-score-content span {
    display: block;

    margin-top: 2px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 10px;
}


/*
|--------------------------------------------------------------------------
| RESULT DETAILS
|--------------------------------------------------------------------------
*/

.education-admin-attempt-result-details {
    display: grid;

    grid-template-columns:
        repeat(3, minmax(0,1fr));

    gap: 12px;
}


.education-admin-attempt-result-item {
    min-height: 110px;

    display: flex;
    flex-direction: column;
    justify-content: space-between;

    padding: 17px;

    border-radius: 16px;

    background: #fbf9f3;

    border: 1px solid rgba(120,105,78,.08);
}


.education-admin-attempt-result-item span {
    display: flex;
    align-items: center;
    gap: 7px;

    color: #8c8476;

    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    font-weight: 600;

    line-height: 1.7;
}


.education-admin-attempt-result-item span i {
    color: #b99552;
}


.education-admin-attempt-result-item strong {
    margin-top: 12px;

    color: #4d483e;

    font-family: 'Cairo', sans-serif;
    font-size: 21px;
    font-weight: 800;
}


/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/

.education-admin-attempt-student {
    display: flex;
    align-items: center;

    gap: 15px;
}


.education-admin-attempt-avatar {
    width: 65px;
    height: 65px;

    flex: 0 0 65px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 18px;

    background:
        linear-gradient(
            135deg,
            #f5efe1,
            #e9dfc8
        );

    color: #8b6d39;

    font-size: 24px;
}


.education-admin-attempt-student-info {
    min-width: 0;

    display: flex;
    flex-direction: column;
    gap: 6px;
}


.education-admin-attempt-student-info strong {
    color: #443f36;

    font-family: 'Cairo', sans-serif;
    font-size: 15px;
}


.education-admin-attempt-student-info span {
    display: flex;
    align-items: center;
    gap: 6px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


.education-admin-attempt-student-info span i {
    color: #6f8068;
}


/*
|--------------------------------------------------------------------------
| ANSWERS
|--------------------------------------------------------------------------
*/

.education-admin-attempt-answers {
    padding: 20px;
}


.education-admin-attempt-answer {
    overflow: hidden;

    margin-bottom: 14px;

    border-radius: 18px;

    background: #fff;

    border: 1px solid rgba(120,105,78,.10);

    box-shadow:
        0 5px 18px rgba(70,58,35,.035);

    transition: .25s ease;
}


.education-admin-attempt-answer:last-child {
    margin-bottom: 0;
}


.education-admin-attempt-answer:hover {
    border-color: rgba(185,149,82,.22);

    box-shadow:
        0 8px 25px rgba(70,58,35,.055);
}


.education-admin-attempt-answer.correct {
    border-right: 4px solid #6f8068;
}


.education-admin-attempt-answer.wrong {
    border-right: 4px solid #a44f46;
}


/*
|--------------------------------------------------------------------------
| ANSWER HEADER
|--------------------------------------------------------------------------
*/

.education-admin-attempt-answer-header {
    display: flex;
    align-items: flex-start;

    gap: 13px;

    padding: 18px 19px;

    background: #fffdf9;

    border-bottom: 1px solid rgba(120,105,78,.07);
}


.education-admin-attempt-question-number {
    width: 38px;
    height: 38px;

    flex: 0 0 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 11px;

    background: #f6efdf;

    color: #b99552;

    font-family: 'Cairo', sans-serif;
    font-size: 12px;
    font-weight: 800;
}


.education-admin-attempt-question {
    flex: 1;

    padding-top: 3px;

    color: #413c33;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;
    font-weight: 700;

    line-height: 1.9;
}


/*
|--------------------------------------------------------------------------
| ANSWER BODY
|--------------------------------------------------------------------------
*/

.education-admin-attempt-answer-body {
    display: grid;

    grid-template-columns: minmax(0,1fr) 110px;

    gap: 15px;

    padding: 18px 19px;
}


.education-admin-attempt-answer-value {
    min-width: 0;

    padding: 13px 15px;

    border-radius: 13px;

    background: rgba(111,128,104,.055);

    border: 1px solid rgba(111,128,104,.10);
}


.education-admin-attempt-answer-value.wrong {
    background: rgba(164,79,70,.045);

    border-color: rgba(164,79,70,.10);
}


.education-admin-attempt-answer-label {
    display: flex;
    align-items: center;
    gap: 6px;

    margin-bottom: 7px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 10px;
    font-weight: 600;
}


.education-admin-attempt-answer-label i {
    color: #6f8068;
}


.education-admin-attempt-answer-value strong {
    display: block;

    color: #504a40;

    font-family: 'Cairo', sans-serif;
    font-size: 13px;

    line-height: 1.8;
}


.education-admin-attempt-answer-value.empty {
    background: #faf8f3;

    border-color: rgba(120,105,78,.08);
}


.education-admin-attempt-answer-value.empty span {
    display: flex;
    align-items: center;
    gap: 7px;

    color: #a29a8c;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


/*
|--------------------------------------------------------------------------
| POINTS
|--------------------------------------------------------------------------
*/

.education-admin-attempt-answer-points {
    min-height: 75px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    background: #fbf9f3;

    border: 1px solid rgba(120,105,78,.08);

    text-align: center;
}


.education-admin-attempt-answer-points span {
    color: #8c8476;

    font-family: 'Cairo', sans-serif;
    font-size: 10px;
}


.education-admin-attempt-answer-points strong {
    margin-top: 4px;

    color: #514a3e;

    font-family: 'Cairo', sans-serif;
    font-size: 20px;
}


/*
|--------------------------------------------------------------------------
| EXPLANATION
|--------------------------------------------------------------------------
*/

.education-admin-attempt-explanation {
    display: flex;
    align-items: flex-start;

    gap: 10px;

    margin: 0 19px 18px;

    padding: 13px 14px;

    border-radius: 13px;

    background: #fffaf0;

    border: 1px solid rgba(185,149,82,.13);
}


.education-admin-attempt-explanation-icon {
    width: 30px;
    height: 30px;

    flex: 0 0 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: rgba(185,149,82,.12);

    color: #b99552;

    font-size: 12px;
}


.education-admin-attempt-explanation strong {
    display: block;

    margin-bottom: 3px;

    color: #8b6d39;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


.education-admin-attempt-explanation p {
    margin: 0;

    color: #776d5d;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;

    line-height: 1.8;
}


/*
|--------------------------------------------------------------------------
| SIDEBAR — QUIZ
|--------------------------------------------------------------------------
*/

.education-admin-attempt-quiz-box {
    padding: 20px;

    text-align: center;
}


.education-admin-attempt-quiz-icon {
    width: 58px;
    height: 58px;

    margin: 0 auto 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 17px;

    background: #f6efdf;

    color: #b99552;

    font-size: 23px;
}


.education-admin-attempt-quiz-box strong {
    display: block;

    color: #484238;

    font-family: 'Cairo', sans-serif;
    font-size: 14px;

    line-height: 1.8;
}


.education-admin-attempt-quiz-box span {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    margin-top: 8px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 10px;
}


.education-admin-attempt-quiz-box span i {
    color: #6f8068;
}


/*
|--------------------------------------------------------------------------
| SIDEBAR INFO
|--------------------------------------------------------------------------
*/

.education-admin-attempt-info-list {
    padding: 8px 20px 18px;
}


.education-admin-attempt-info-item {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 15px;

    padding: 13px 0;

    border-bottom: 1px solid rgba(120,105,78,.07);
}


.education-admin-attempt-info-item:last-child {
    border-bottom: 0;
}


.education-admin-attempt-info-item > div {
    display: flex;
    align-items: center;
    gap: 8px;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 10px;
}


.education-admin-attempt-info-item > div i {
    color: #b99552;

    width: 15px;

    text-align: center;
}


.education-admin-attempt-info-item strong {
    max-width: 150px;

    color: #514a3e;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;

    text-align: left;
}


/*
|--------------------------------------------------------------------------
| SUMMARY CARD
|--------------------------------------------------------------------------
*/

.education-admin-attempt-summary {
    position: relative;

    overflow: hidden;

    padding: 25px 20px;

    border-radius: 21px;

    background:
        linear-gradient(
            145deg,
            #6f8068 0%,
            #596a53 100%
        );

    color: #fff;

    text-align: center;

    box-shadow:
        0 15px 35px rgba(70,90,65,.15);
}


.education-admin-attempt-summary::before {
    content: '';

    position: absolute;

    top: -60px;
    left: -60px;

    width: 150px;
    height: 150px;

    border-radius: 50%;

    background: rgba(255,255,255,.06);
}


.education-admin-attempt-summary > * {
    position: relative;
    z-index: 2;
}


.education-admin-attempt-summary-icon {
    width: 48px;
    height: 48px;

    margin: 0 auto 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 14px;

    background: rgba(255,255,255,.12);

    font-size: 19px;
}


.education-admin-attempt-summary span {
    display: block;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


.education-admin-attempt-summary strong {
    display: block;

    margin-top: 3px;

    font-family: 'Cairo', sans-serif;
    font-size: 32px;
    font-weight: 800;
}


.education-admin-attempt-summary small {
    display: block;

    margin-top: 2px;

    opacity: .78;

    font-family: 'Cairo', sans-serif;
    font-size: 10px;
}


/*
|--------------------------------------------------------------------------
| EMPTY
|--------------------------------------------------------------------------
*/

.education-admin-attempt-empty {
    padding: 45px 20px;

    text-align: center;
}


.education-admin-attempt-empty-icon {
    width: 65px;
    height: 65px;

    margin: 0 auto 15px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 18px;

    background: #f7f3ea;

    color: #b99552;

    font-size: 25px;
}


.education-admin-attempt-empty h3 {
    margin: 0;

    color: #514a3e;

    font-family: 'Amiri', serif;
    font-size: 23px;
}


.education-admin-attempt-empty p {
    margin: 6px 0 0;

    color: #8b8375;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
}


/*
|--------------------------------------------------------------------------
| FULL BUTTON
|--------------------------------------------------------------------------
*/

.education-admin-attempt-full-button {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    min-height: 47px;

    padding: 0 18px;

    border-radius: 13px;

    background: #f5efe1;

    border: 1px solid rgba(185,149,82,.14);

    color: #806638;

    text-decoration: none;

    font-family: 'Cairo', sans-serif;
    font-size: 11px;
    font-weight: 700;

    transition: .25s ease;
}


.education-admin-attempt-full-button:hover {
    background: #eee4cd;

    transform: translateY(-2px);
}


/*
|--------------------------------------------------------------------------
| RESPONSIVE
|--------------------------------------------------------------------------
*/

@media (max-width: 1100px) {

    .education-admin-attempt-grid {
        grid-template-columns: 1fr;
    }


    .education-admin-attempt-sidebar {
        position: static;

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0,1fr));
    }


    .education-admin-attempt-summary {
        grid-column: span 2;
    }


    .education-admin-attempt-full-button {
        grid-column: span 2;
    }

}


@media (max-width: 850px) {

    .education-admin-attempt-header {
        align-items: flex-start;
        flex-direction: column;
    }


    .education-admin-attempt-result {
        grid-template-columns: 1fr;
    }


    .education-admin-attempt-result-details {
        grid-template-columns:
            repeat(3, minmax(0,1fr));
    }

}


@media (max-width: 650px) {

    .education-admin-attempt-header {
        padding: 22px 18px;
    }


    .education-admin-attempt-title-row h1 {
        font-size: 28px;
    }


    .education-admin-attempt-title-icon {
        width: 46px;
        height: 46px;

        flex-basis: 46px;
    }


    .education-admin-attempt-card-header {
        padding: 17px;
    }


    .education-admin-attempt-card-body {
        padding: 18px;
    }


    .education-admin-attempt-result {
        padding: 20px 17px;
    }


    .education-admin-attempt-result-details {
        grid-template-columns: 1fr;
    }


    .education-admin-attempt-result-item {
        min-height: auto;
    }


    .education-admin-attempt-answer-body {
        grid-template-columns: 1fr;
    }


    .education-admin-attempt-answer-points {
        min-height: 60px;
    }


    .education-admin-attempt-answer-header {
        flex-wrap: wrap;
    }


    .education-admin-attempt-question {
        min-width: calc(100% - 55px);
    }


    .education-admin-attempt-answer-header
    .education-admin-attempt-status {
        margin-right: 51px;
    }


    .education-admin-attempt-sidebar {
        grid-template-columns: 1fr;
    }


    .education-admin-attempt-summary,
    .education-admin-attempt-full-button {
        grid-column: auto;
    }

}


@media (max-width: 450px) {

    .education-admin-attempt-title-row {
        align-items: flex-start;
    }


    .education-admin-attempt-title-row h1 {
        font-size: 25px;
    }


    .education-admin-attempt-description {
        font-size: 11px;
    }


    .education-admin-attempt-back {
        width: 100%;
    }


    .education-admin-attempt-header-action {
        width: 100%;
    }


    .education-admin-attempt-score-circle {
        width: 145px;
        height: 145px;
    }


    .education-admin-attempt-score-content strong {
        font-size: 28px;
    }


    .education-admin-attempt-student {
        align-items: flex-start;
    }

}

</style>


<div class="education-admin-attempt-page">


    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-attempt-header">

        <div class="education-admin-attempt-header-main">

            <span class="education-admin-attempt-eyebrow">

                <i class="fa-solid fa-chart-line"></i>

                {{ __('education_admin.quiz_attempt_show.header_label') }}

            </span>


            <div class="education-admin-attempt-title-row">

                <div class="education-admin-attempt-title-icon">

                    <i class="fa-solid fa-clipboard-check"></i>

                </div>


                <div>

                    <h1>
                        {{ __('education_admin.quiz_attempt_show.title') }}
                    </h1>


                    <span class="education-admin-attempt-quiz-name">

                        <i class="fa-solid fa-clipboard-question"></i>

                        {{ $attempt->quiz->title ?? __('education_admin.quiz_attempt_show.fallback.quiz') }}

                    </span>

                </div>

            </div>


            <p class="education-admin-attempt-description">

                {{ __('education_admin.quiz_attempt_show.description') }}

            </p>

        </div>


        <div class="education-admin-attempt-header-action">

            <a
                href="{{ route('education.admin.quiz-attempts.index') }}"
                class="education-admin-attempt-back"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.quiz_attempt_show.actions.back') }}

            </a>

        </div>

    </div>



    {{-- =========================================================
        SUCCESS
    ========================================================== --}}

    @if(session('success'))

        <div class="education-admin-attempt-alert">

            <div class="education-admin-attempt-alert-icon">

                <i class="fa-solid fa-circle-check"></i>

            </div>


            <div>

                <strong>
                    {{ __('education_admin.quiz_attempt_show.alerts.success_title') }}
                </strong>

                <p>
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif



    {{-- =========================================================
        MAIN GRID
    ========================================================== --}}

    <div class="education-admin-attempt-grid">


        {{-- =====================================================
            MAIN
        ====================================================== --}}

        <main class="education-admin-attempt-main">


            {{-- =================================================
                RESULT CARD
            ================================================== --}}

            <section class="education-admin-attempt-card">

                <div class="education-admin-attempt-card-header">

                    <div class="education-admin-attempt-card-heading">

                        <div class="education-admin-attempt-card-icon">

                            <i class="fa-solid fa-ranking-star"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_attempt_show.result.section_label') }}
                            </span>

                            <h2>
                                {{ __('education_admin.quiz_attempt_show.result.title') }}
                            </h2>

                        </div>

                    </div>


                    @if($attempt->passed)

                        <span class="education-admin-attempt-status success">

                            <i class="fa-solid fa-circle-check"></i>

                            {{ __('education_admin.quiz_attempt_show.result.passed') }}

                        </span>

                    @else

                        <span class="education-admin-attempt-status danger">

                            <i class="fa-solid fa-circle-xmark"></i>

                            {{ __('education_admin.quiz_attempt_show.result.failed') }}

                        </span>

                    @endif

                </div>


                <div class="education-admin-attempt-result">


                    {{-- SCORE --}}

                    <div class="education-admin-attempt-score-wrap">

                        <div
                            class="education-admin-attempt-score-circle"
                            style="--score: {{ min(max((float) $attempt->percentage, 0), 100) }}%;"
                        >

                            <div class="education-admin-attempt-score-content">

                                <strong>
                                    {{ number_format((float) $attempt->percentage, 0) }}%
                                </strong>

                                <span>
                                    {{ __('education_admin.quiz_attempt_show.result.score_label') }}
                                </span>

                            </div>

                        </div>

                    </div>



                    {{-- DETAILS --}}

                    <div class="education-admin-attempt-result-details">


                        <div class="education-admin-attempt-result-item">

                            <span>

                                <i class="fa-solid fa-star"></i>

                                {{ __('education_admin.quiz_attempt_show.result.earned_score') }}

                            </span>

                            <strong>
                                {{ $attempt->score }}
                            </strong>

                        </div>


                        <div class="education-admin-attempt-result-item">

                            <span>

                                <i class="fa-solid fa-bullseye"></i>

                                {{ __('education_admin.quiz_attempt_show.result.total_score') }}

                            </span>

                            <strong>
                                {{ $attempt->total_points }}
                            </strong>

                        </div>


                        <div class="education-admin-attempt-result-item">

                            <span>

                                <i class="fa-solid fa-percent"></i>

                                {{ __('education_admin.quiz_attempt_show.result.passing_score') }}

                            </span>

                            <strong>
                                {{ $attempt->quiz->pass_percentage ?? 0 }}%
                            </strong>

                        </div>


                    </div>

                </div>

            </section>



            {{-- =================================================
                STUDENT
            ================================================== --}}

            <section class="education-admin-attempt-card">

                <div class="education-admin-attempt-card-header">

                    <div class="education-admin-attempt-card-heading">

                        <div class="education-admin-attempt-card-icon green">

                            <i class="fa-solid fa-user-graduate"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_attempt_show.student.section_label') }}
                            </span>

                            <h2>
                                {{ __('education_admin.quiz_attempt_show.student.title') }}
                            </h2>

                        </div>

                    </div>

                </div>


                <div class="education-admin-attempt-card-body">

                    <div class="education-admin-attempt-student">

                        <div class="education-admin-attempt-avatar">

                            <i class="fa-solid fa-user"></i>

                        </div>


                        <div class="education-admin-attempt-student-info">

                            <strong>
                                {{ $attempt->student->name ?? __('education_admin.quiz_attempt_show.fallback.unknown_student') }}
                            </strong>


                            @if($attempt->student?->email)

                                <span>

                                    <i class="fa-solid fa-envelope"></i>

                                    {{ $attempt->student->email }}

                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </section>



            {{-- =================================================
                ANSWERS
            ================================================== --}}

            <section class="education-admin-attempt-card">

                <div class="education-admin-attempt-card-header">

                    <div class="education-admin-attempt-card-heading">

                        <div class="education-admin-attempt-card-icon">

                            <i class="fa-solid fa-list-check"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_attempt_show.answers.section_label') }}
                            </span>

                            <h2>
                                {{ __('education_admin.quiz_attempt_show.answers.title') }}
                            </h2>

                        </div>

                    </div>


                    <span class="education-admin-attempt-status warning">

                        <i class="fa-solid fa-list-ol"></i>

                        {{ $attempt->answers->count() }}
                        {{ __('education_admin.quiz_attempt_show.answers.count') }}

                    </span>

                </div>


                <div class="education-admin-attempt-answers">


                    @forelse($attempt->answers as $answer)

                        <article
                            class="
                                education-admin-attempt-answer
                                {{ $answer->is_correct ? 'correct' : 'wrong' }}
                            "
                        >


                            {{-- ANSWER HEADER --}}

                            <div class="education-admin-attempt-answer-header">

                                <div class="education-admin-attempt-question-number">

                                    {{ $loop->iteration }}

                                </div>


                                <div class="education-admin-attempt-question">

                                    {{ $answer->question->question ?? __('education_admin.quiz_attempt_show.fallback.question_unavailable') }}

                                </div>


                                @if($answer->is_correct)

                                    <span class="education-admin-attempt-status success">

                                        <i class="fa-solid fa-check"></i>

                                        {{ __('education_admin.quiz_attempt_show.answers.correct') }}

                                    </span>

                                @else

                                    <span class="education-admin-attempt-status danger">

                                        <i class="fa-solid fa-xmark"></i>

                                        {{ __('education_admin.quiz_attempt_show.answers.wrong') }}

                                    </span>

                                @endif

                            </div>



                            {{-- ANSWER BODY --}}

                            <div class="education-admin-attempt-answer-body">


                                @if($answer->selectedOption)

                                    <div
                                        class="
                                            education-admin-attempt-answer-value
                                            {{ !$answer->is_correct ? 'wrong' : '' }}
                                        "
                                    >

                                        <span class="education-admin-attempt-answer-label">

                                            <i class="fa-solid fa-circle-dot"></i>

                                            {{ __('education_admin.quiz_attempt_show.answers.student_answer') }}

                                        </span>


                                        <strong>

                                            {{ $answer->selectedOption->option }}

                                        </strong>

                                    </div>

                                @elseif($answer->answer_text)

                                    <div class="education-admin-attempt-answer-value">

                                        <span class="education-admin-attempt-answer-label">

                                            <i class="fa-solid fa-align-right"></i>

                                            {{ __('education_admin.quiz_attempt_show.answers.student_answer') }}

                                        </span>


                                        <strong>

                                            {{ $answer->answer_text }}

                                        </strong>

                                    </div>

                                @else

                                    <div class="education-admin-attempt-answer-value empty">

                                        <span>

                                            <i class="fa-solid fa-minus"></i>

                                            {{ __('education_admin.quiz_attempt_show.answers.no_answer') }}

                                        </span>

                                    </div>

                                @endif



                                {{-- POINTS --}}

                                <div class="education-admin-attempt-answer-points">

                                    <span>
                                        {{ __('education_admin.quiz_attempt_show.answers.points') }}
                                    </span>

                                    <strong>

                                        {{ $answer->points_earned }}

                                    </strong>

                                </div>

                            </div>



                            {{-- EXPLANATION --}}

                            @if($answer->question?->explanation)

                                <div class="education-admin-attempt-explanation">

                                    <div class="education-admin-attempt-explanation-icon">

                                        <i class="fa-solid fa-lightbulb"></i>

                                    </div>


                                    <div>

                                        <strong>
                                            {{ __('education_admin.quiz_attempt_show.answers.explanation') }}
                                        </strong>

                                        <p>
                                            {{ $answer->question->explanation }}
                                        </p>

                                    </div>

                                </div>

                            @endif


                        </article>

                    @empty

                        <div class="education-admin-attempt-empty">

                            <div class="education-admin-attempt-empty-icon">

                                <i class="fa-solid fa-inbox"></i>

                            </div>


                            <h3>
                                {{ __('education_admin.quiz_attempt_show.empty.title') }}
                            </h3>


                            <p>
                                {{ __('education_admin.quiz_attempt_show.empty.description') }}
                            </p>

                        </div>

                    @endforelse

                </div>

            </section>


        </main>



        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside class="education-admin-attempt-sidebar">


            {{-- =================================================
                QUIZ
            ================================================== --}}

            <section class="education-admin-attempt-card">

                <div class="education-admin-attempt-card-header">

                    <div class="education-admin-attempt-card-heading">

                        <div class="education-admin-attempt-card-icon">

                            <i class="fa-solid fa-clipboard-list"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_attempt_show.quiz.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_attempt_show.quiz.title') }}
                            </h3>

                        </div>

                    </div>

                </div>


                <div class="education-admin-attempt-quiz-box">

                    <div class="education-admin-attempt-quiz-icon">

                        <i class="fa-solid fa-clipboard-question"></i>

                    </div>


                    <strong>

                        {{ $attempt->quiz->title ?? __('education_admin.quiz_attempt_show.fallback.quiz') }}

                    </strong>


                    @if($attempt->quiz?->lesson)

                        <span>

                            <i class="fa-solid fa-book-open"></i>

                            {{ $attempt->quiz->lesson->title }}

                        </span>

                    @endif

                </div>

            </section>



            {{-- =================================================
                ATTEMPT INFORMATION
            ================================================== --}}

            <section class="education-admin-attempt-card">

                <div class="education-admin-attempt-card-header">

                    <div class="education-admin-attempt-card-heading">

                        <div class="education-admin-attempt-card-icon green">

                            <i class="fa-solid fa-circle-info"></i>

                        </div>


                        <div>

                            <span>
                                {{ __('education_admin.quiz_attempt_show.attempt.section_label') }}
                            </span>

                            <h3>
                                {{ __('education_admin.quiz_attempt_show.attempt.title') }}
                            </h3>

                        </div>

                    </div>

                </div>


                <div class="education-admin-attempt-info-list">


                    {{-- ATTEMPT NUMBER --}}

                    <div class="education-admin-attempt-info-item">

                        <div>

                            <i class="fa-solid fa-hashtag"></i>

                            <span>
                                {{ __('education_admin.quiz_attempt_show.attempt.number') }}
                            </span>

                        </div>


                        <strong>
                            {{ $attempt->attempt_number }}
                        </strong>

                    </div>



                    {{-- STATUS --}}

                    <div class="education-admin-attempt-info-item">

                        <div>

                            <i class="fa-solid fa-flag"></i>

                            <span>
                                {{ __('education_admin.quiz_attempt_show.attempt.status_label') }}
                            </span>

                        </div>


                        <strong>

                            @switch($attempt->status)

                                @case('completed')
                                    {{ __('education_admin.quiz_attempt_show.status.completed') }}
                                    @break

                                @case('in_progress')
                                    {{ __('education_admin.quiz_attempt_show.status.in_progress') }}
                                    @break

                                @case('abandoned')
                                    {{ __('education_admin.quiz_attempt_show.status.abandoned') }}
                                    @break

                                @default
                                    {{ $attempt->status ?? __('education_admin.quiz_attempt_show.status.unknown') }}

                            @endswitch

                        </strong>

                    </div>



                    {{-- STARTED --}}

                    <div class="education-admin-attempt-info-item">

                        <div>

                            <i class="fa-solid fa-calendar-plus"></i>

                            <span>
                                {{ __('education_admin.quiz_attempt_show.attempt.started_at') }}
                            </span>

                        </div>


                        <strong>

                            {{ $attempt->started_at?->format('Y-m-d H:i') ?? __('education_admin.quiz_attempt_show.dates.not_available') }}

                        </strong>

                    </div>



                    {{-- COMPLETED --}}

                    <div class="education-admin-attempt-info-item">

                        <div>

                            <i class="fa-solid fa-calendar-check"></i>

                            <span>
                                {{ __('education_admin.quiz_attempt_show.attempt.completed_at') }}
                            </span>

                        </div>


                        <strong>

                            {{ $attempt->completed_at?->format('Y-m-d H:i') ?? __('education_admin.quiz_attempt_show.dates.not_completed') }}

                        </strong>

                    </div>


                </div>

            </section>



            {{-- =================================================
                SUMMARY
            ================================================== --}}

            <div class="education-admin-attempt-summary">

                <div class="education-admin-attempt-summary-icon">

                    @if($attempt->passed)

                        <i class="fa-solid fa-trophy"></i>

                    @else

                        <i class="fa-solid fa-chart-line"></i>

                    @endif

                </div>


                <span>

                    {{ $attempt->passed
                        ? __('education_admin.quiz_attempt_show.summary.passed')
                        : __('education_admin.quiz_attempt_show.summary.needs_improvement')
                    }}

                </span>


                <strong>

                    {{ number_format((float) $attempt->percentage, 2) }}%

                </strong>


                <small>

                    {{ $attempt->score }}

                    {{ __('education_admin.quiz_attempt_show.summary.of') }}

                    {{ $attempt->total_points }}

                </small>

            </div>



            {{-- =================================================
                BACK
            ================================================== --}}

            <a
                href="{{ route('education.admin.quiz-attempts.index') }}"
                class="education-admin-attempt-full-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.quiz_attempt_show.actions.back_all') }}

            </a>


        </aside>


    </div>

</div>

@endsection
