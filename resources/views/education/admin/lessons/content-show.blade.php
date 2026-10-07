@extends('education.admin.layouts.app')

@section('title', __('education_admin.lessons.content_show.page_title'))

@section('content')

<style>
/* =========================================================
   EDUCATION ADMIN CONTENT SHOW
   Cream / Olive Green / Gold
========================================================= */

.education-admin-content-create-page {
    direction: rtl;
    color: #30372a;
}

/* =========================================================
   HEADER
========================================================= */

.education-admin-content-create-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 25px;
    margin-bottom: 28px;
}

.education-admin-content-create-heading {
    flex: 1;
}

.education-admin-page-header-label {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    color: #8c6a2d;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 10px;
}

.education-admin-page-header-label i {
    color: #c69b45;
}

.education-admin-content-title-row {
    display: flex;
    align-items: center;
    gap: 15px;
}

.education-admin-content-title-icon {
    width: 54px;
    height: 54px;
    flex-shrink: 0;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #d4ad61, #b98a38);
    color: #fffdf7;
    font-size: 21px;
    box-shadow: 0 10px 25px rgba(181, 139, 61, .18);
}

.education-admin-content-title-row h2 {
    margin: 0;
    color: #30372a;
    font-size: 27px;
    font-weight: 800;
}

.education-admin-content-lesson-name {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    margin-top: 7px;
    color: #7f8478;
    font-size: 13px;
    font-weight: 700;
}

.education-admin-content-lesson-name i {
    color: #a47a2c;
}

.education-admin-content-create-heading > p {
    margin: 10px 0 0;
    color: #7c8175;
    font-size: 14px;
    line-height: 1.8;
}

.education-admin-content-header-actions {
    flex-shrink: 0;
}

.education-admin-content-back-button {
    min-height: 46px;
    padding: 0 18px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    border: 1px solid #ded8c9;
    border-radius: 13px;
    background: #fffdf8;
    color: #59604e;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    transition: .25s ease;
}

.education-admin-content-back-button:hover {
    color: #3f4a2f;
    border-color: #c9b98d;
    background: #f8f3e7;
    transform: translateY(-2px);
}

/* =========================================================
   GRID
========================================================= */

.education-admin-content-form-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 320px;
    gap: 25px;
    align-items: start;
}

.education-admin-content-form-main {
    min-width: 0;
}

.education-admin-content-form-sidebar {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* =========================================================
   CARD
========================================================= */

.education-admin-content-form-card {
    margin-bottom: 22px;
    overflow: hidden;
    border: 1px solid #e2dccd;
    border-radius: 21px;
    background: #fffdf8;
    box-shadow: 0 12px 35px rgba(49, 59, 39, .06);
}

.education-admin-content-form-sidebar .education-admin-content-form-card {
    margin-bottom: 0;
}

.education-admin-content-form-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 21px 23px;
    border-bottom: 1px solid #ece7da;
}

.education-admin-content-form-card-icon {
    width: 43px;
    height: 43px;
    flex-shrink: 0;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef0e8;
    color: #4a5839;
}

.education-admin-content-form-card-icon.gold {
    background: #f7efdf;
    color: #ad8236;
}

.education-admin-content-form-card-icon.green {
    background: #eaf0e4;
    color: #53613e;
}

.education-admin-content-form-card-header span {
    display: block;
    margin-bottom: 3px;
    color: #96998f;
    font-size: 12px;
}

.education-admin-content-form-card-header h3 {
    margin: 0;
    color: #343b2e;
    font-size: 17px;
    font-weight: 800;
}

.education-admin-content-form-body {
    padding: 25px;
}

/* =========================================================
   FIELD
========================================================= */

.education-admin-content-field {
    margin-bottom: 21px;
}

.education-admin-content-field:last-child {
    margin-bottom: 0;
}

.education-admin-content-field > label {
    display: block;
    margin-bottom: 8px;
    color: #4b5242;
    font-size: 13px;
    font-weight: 800;
}

/* =========================================================
   TYPE DISPLAY
========================================================= */

.education-admin-content-type-display {
    min-height: 70px;
    padding: 12px 14px;
    display: flex;
    align-items: center;
    gap: 13px;
    border: 1px solid #dfd8c9;
    border-radius: 14px;
    background: #faf7ef;
}

.education-admin-content-type-icon {
    width: 43px;
    height: 43px;
    flex-shrink: 0;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #465236;
    color: #dfba68;
    font-size: 17px;
}

.education-admin-content-type-display strong {
    display: block;
    color: #3f4736;
    font-size: 14px;
    font-weight: 800;
}

.education-admin-content-type-display small {
    display: block;
    margin-top: 4px;
    color: #92958c;
    font-size: 11px;
}

/* =========================================================
   VIEW BOX
========================================================= */

.education-admin-content-view-box {
    min-height: 55px;
    padding: 14px 16px;
    box-sizing: border-box;
    border: 1px solid #dfd8c9;
    border-radius: 13px;
    background: #faf8f2;
    color: #4b5243;
    font-size: 13px;
    line-height: 1.9;
    white-space: normal;
    overflow-wrap: anywhere;
}

.education-admin-content-view-box.large {
    min-height: 170px;
    white-space: pre-wrap;
}

/* =========================================================
   URL
========================================================= */

.education-admin-content-url-wrapper {
    min-height: 56px;
    padding: 8px 13px;
    display: flex;
    align-items: center;
    gap: 11px;
    border: 1px solid #dfd8c9;
    border-radius: 13px;
    background: #faf8f2;
}

.education-admin-content-url-wrapper > i {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 9px;
    background: #eef0e8;
    color: #53613e;
}

.education-admin-content-view-link {
    min-width: 0;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #52603d;
    text-decoration: none;
    font-size: 13px;
    font-weight: 700;
    direction: ltr;
    text-align: left;
    overflow-wrap: anywhere;
}

.education-admin-content-view-link:hover {
    color: #9a702b;
}

.education-admin-content-view-link i {
    flex-shrink: 0;
    color: #b58b40;
    font-size: 11px;
}

/* =========================================================
   CURRENT FILE
========================================================= */

.education-admin-content-current-file {
    overflow: hidden;
    border: 1px solid #dfd8c9;
    border-radius: 16px;
    background: #faf8f2;
}

.education-admin-content-current-file-header {
    min-height: 46px;
    padding: 0 15px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #e9e3d7;
    background: #f7f3e9;
}

.education-admin-content-current-file-header span {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #505748;
    font-size: 12px;
    font-weight: 800;
}

.education-admin-content-current-file-header i {
    color: #a47a2c;
}

/* =========================================================
   VIDEO
========================================================= */

.education-admin-content-video-wrapper {
    overflow: hidden;
    border: 1px solid #dfd8c9;
    border-radius: 16px;
    background: #151812;
    box-shadow: 0 10px 30px rgba(30, 36, 25, .10);
}

.education-admin-content-video-frame {
    position: relative;
    width: 100%;
    aspect-ratio: 16 / 9;
    background: #151812;
}

.education-admin-content-video-frame iframe,
.education-admin-content-video-frame video {
    display: block;
    width: 100%;
    height: 100%;
    border: 0;
    object-fit: contain;
    background: #151812;
}

.education-admin-content-video-info {
    padding: 13px 15px;
    border-top: 1px solid rgba(255,255,255,.08);
    background: #fffdf8;
}

.education-admin-content-video-info a {
    color: #52603d;
    text-decoration: none;
    font-size: 12px;
    font-weight: 800;
    direction: ltr;
    overflow-wrap: anywhere;
}

.education-admin-content-video-info a:hover {
    color: #9a702b;
}

/* =========================================================
   IMAGE
========================================================= */

.education-admin-content-current-image {
    padding: 18px;
    display: flex;
    justify-content: center;
    background: #fffdf8;
}

.education-admin-content-current-image img {
    display: block;
    max-width: 100%;
    max-height: 520px;
    border-radius: 12px;
    object-fit: contain;
    box-shadow: 0 8px 25px rgba(40, 50, 31, .08);
}

/* =========================================================
   FILE INFO
========================================================= */

.education-admin-content-current-file-info {
    min-height: 58px;
    padding: 10px 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    border-top: 1px solid #e9e3d7;
    background: #f7f3e9;
}

.education-admin-content-current-file-info strong {
    min-width: 0;
    color: #4b5243;
    font-size: 12px;
    overflow-wrap: anywhere;
}

.education-admin-content-current-file-info span {
    flex-shrink: 0;
    color: #92958c;
    font-size: 11px;
}

/* =========================================================
   FILE ROW
========================================================= */

.education-admin-content-current-file-row {
    min-height: 85px;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 13px;
    background: #fffdf8;
}

.education-admin-content-current-file-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    background: #eef0e8;
    color: #53613e;
    font-size: 20px;
}

.education-admin-content-current-file-row > div:nth-child(2) {
    min-width: 0;
    flex: 1;
}

.education-admin-content-current-file-row strong {
    display: block;
    color: #414837;
    font-size: 13px;
    overflow-wrap: anywhere;
}

.education-admin-content-current-file-row span {
    display: block;
    margin-top: 5px;
    color: #92958c;
    font-size: 11px;
    overflow-wrap: anywhere;
}

.education-admin-content-current-file-view {
    flex-shrink: 0;
    min-height: 39px;
    padding: 0 13px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    border: 1px solid #d9cfb7;
    border-radius: 10px;
    background: #faf6ec;
    color: #735d2e;
    text-decoration: none;
    font-size: 11px;
    font-weight: 800;
    transition: .2s ease;
}

.education-admin-content-current-file-view:hover {
    background: #f3ead7;
    border-color: #bba36b;
    transform: translateY(-1px);
}

/* =========================================================
   EMPTY
========================================================= */

.education-admin-content-view-empty {
    min-height: 130px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    border: 1px dashed #d4cbb9;
    border-radius: 14px;
    background: #faf8f2;
    color: #92958c;
    text-align: center;
    font-size: 12px;
}

.education-admin-content-view-empty i {
    color: #b08a43;
    font-size: 25px;
}

/* =========================================================
   SETTINGS
========================================================= */

.education-admin-content-settings-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
}

.education-admin-content-view-value {
    min-height: 50px;
    padding: 0 14px;
    display: flex;
    align-items: center;
    border: 1px solid #dfd8c9;
    border-radius: 12px;
    background: #faf8f2;
    color: #4e5645;
    font-size: 13px;
    font-weight: 800;
}

.education-admin-content-status-box {
    min-width: 0;
}

.education-admin-content-status-box > label {
    display: block;
    margin-bottom: 8px;
    color: #4b5242;
    font-size: 13px;
    font-weight: 800;
}

.education-admin-content-status-display {
    min-height: 50px;
    padding: 0 14px;
    display: flex;
    align-items: center;
    border: 1px solid #dfd8c9;
    border-radius: 12px;
    background: #faf8f2;
}

.education-admin-content-status {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    font-weight: 800;
}

.education-admin-content-status.active {
    color: #4e633c;
}

.education-admin-content-status.active i {
    color: #6b8a4d;
}

.education-admin-content-status.inactive {
    color: #9a5749;
}

.education-admin-content-status.inactive i {
    color: #b96a58;
}

/* =========================================================
   TYPE SUMMARY
========================================================= */

.education-admin-content-type-summary {
    padding: 22px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    text-align: center;
}

.education-admin-content-type-summary-icon {
    width: 64px;
    height: 64px;
    border-radius: 17px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f7efdf;
    color: #a67d32;
    font-size: 25px;
}

.education-admin-content-type-summary strong {
    color: #414837;
    font-size: 14px;
}

/* =========================================================
   ACTIONS
========================================================= */

.education-admin-content-form-actions {
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.education-admin-content-submit-button,
.education-admin-content-cancel-button {
    min-height: 48px;
    padding: 0 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    border-radius: 12px;
    text-decoration: none;
    font-family: inherit;
    font-size: 13px;
    font-weight: 800;
    transition: .2s ease;
}

.education-admin-content-submit-button {
    border: 0;
    background: linear-gradient(135deg, #53613e, #3f4a2f);
    color: #fffdf7;
    box-shadow: 0 8px 18px rgba(63, 74, 47, .14);
}

.education-admin-content-submit-button:hover {
    color: #fffdf7;
    transform: translateY(-2px);
}

.education-admin-content-cancel-button {
    border: 1px solid #ddd7ca;
    background: #fffdf8;
    color: #666b61;
}

.education-admin-content-cancel-button:hover {
    background: #f8f3e7;
    color: #3f4a2f;
}

/* =========================================================
   DELETE
========================================================= */

.education-admin-content-delete-card {
    padding: 20px;
    border: 1px solid #ead0ca;
    border-radius: 19px;
    background: #fff6f3;
    box-shadow: 0 10px 25px rgba(120, 66, 53, .04);
}

.education-admin-content-delete-icon {
    width: 43px;
    height: 43px;
    margin-bottom: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: #f9dfd9;
    color: #a85344;
}

.education-admin-content-delete-card strong {
    display: block;
    color: #7f4137;
    font-size: 14px;
    font-weight: 800;
}

.education-admin-content-delete-card p {
    margin: 7px 0 15px;
    color: #9b6c64;
    font-size: 11px;
    line-height: 1.8;
}

.education-admin-content-delete-button {
    width: 100%;
    min-height: 44px;
    border: 1px solid #e3bdb5;
    border-radius: 11px;
    background: #fff;
    color: #a34f41;
    cursor: pointer;
    font-family: inherit;
    font-size: 12px;
    font-weight: 800;
    transition: .2s ease;
}

.education-admin-content-delete-button:hover {
    background: #fbe8e4;
    border-color: #d79d93;
    transform: translateY(-1px);
}

/* =========================================================
   NOTE
========================================================= */

.education-admin-content-note {
    padding: 19px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    border: 1px solid #e2dccd;
    border-radius: 18px;
    background: #fffdf8;
}

.education-admin-content-note-icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    background: #f7efdf;
    color: #aa8138;
}

.education-admin-content-note strong {
    display: block;
    margin-bottom: 5px;
    color: #4a523d;
    font-size: 13px;
}

.education-admin-content-note p {
    margin: 0;
    color: #92958c;
    font-size: 11px;
    line-height: 1.8;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1100px) {

    .education-admin-content-form-grid {
        grid-template-columns: 1fr;
    }

    .education-admin-content-form-sidebar {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: start;
    }

    .education-admin-content-note {
        grid-column: 1 / -1;
    }
}

@media (max-width: 800px) {

    .education-admin-content-create-header {
        flex-direction: column;
        align-items: stretch;
    }

    .education-admin-content-header-actions {
        width: 100%;
    }

    .education-admin-content-back-button {
        width: 100%;
    }

    .education-admin-content-form-sidebar {
        grid-template-columns: 1fr;
    }

    .education-admin-content-settings-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {

    .education-admin-content-title-row h2 {
        font-size: 22px;
    }

    .education-admin-content-form-body {
        padding: 18px;
    }

    .education-admin-content-form-card-header {
        padding: 18px;
    }

    .education-admin-content-current-file-row {
        flex-wrap: wrap;
    }

    .education-admin-content-current-file-view {
        width: 100%;
    }

    .education-admin-content-current-file-info {
        align-items: flex-start;
        flex-direction: column;
        gap: 5px;
    }
}
</style>


@php
    /*
    |--------------------------------------------------------------------------
    | VIDEO EMBED URL
    |--------------------------------------------------------------------------
    | يدعم: YouTube / YouTube Shorts / youtu.be / Google Drive / Vimeo
    | ويعيد null إذا كان الرابط ملف فيديو مباشر مثل mp4.
    */

    $videoEmbedUrl = null;
    $videoDirectUrl = null;

    if ($content->type === 'video' && $content->url) {
        $videoUrl = trim($content->url);

        try {
            $videoParsed = parse_url($videoUrl);
            $videoHost = strtolower($videoParsed['host'] ?? '');
            $videoPath = $videoParsed['path'] ?? '';
            $videoQuery = $videoParsed['query'] ?? '';

            // YouTube
            if (str_contains($videoHost, 'youtube.com') || str_contains($videoHost, 'youtu.be')) {
                $youtubeId = null;

                if (str_contains($videoHost, 'youtu.be')) {
                    $youtubeId = trim($videoPath, '/');
                } elseif (preg_match('/(?:^|&)v=([^&]+)/', $videoQuery, $matches)) {
                    $youtubeId = $matches[1];
                } elseif (preg_match('#/(?:embed|shorts|live)/([^/?]+)#', $videoPath, $matches)) {
                    $youtubeId = $matches[1];
                }

                if ($youtubeId) {
                    $videoEmbedUrl = 'https://www.youtube.com/embed/' . rawurlencode($youtubeId);
                }
            }

            // Google Drive
            if (!$videoEmbedUrl && str_contains($videoHost, 'drive.google.com')) {
                if (preg_match('#/file/d/([^/]+)#', $videoPath, $matches)) {
                    $videoEmbedUrl = 'https://drive.google.com/file/d/' . $matches[1] . '/preview';
                } elseif (preg_match('/(?:^|&)id=([^&]+)/', $videoQuery, $matches)) {
                    $videoEmbedUrl = 'https://drive.google.com/file/d/' . $matches[1] . '/preview';
                }
            }

            // Vimeo
            if (!$videoEmbedUrl && str_contains($videoHost, 'vimeo.com')) {
                if (preg_match('#/(?:video/)?(\d+)#', $videoPath, $matches)) {
                    $videoEmbedUrl = 'https://player.vimeo.com/video/' . $matches[1];
                }
            }

            // Direct video files
            if (!$videoEmbedUrl && preg_match('/\.(mp4|webm|ogg)(?:\?.*)?$/i', $videoUrl)) {
                $videoDirectUrl = $videoUrl;
            }
        } catch (\Throwable $e) {
            $videoEmbedUrl = null;
            $videoDirectUrl = null;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CONTENT FILE URL
    |--------------------------------------------------------------------------
    */

    $contentFileUrl = null;

    if ($content->file_path) {

        if (
            \Illuminate\Support\Str::startsWith(
                $content->file_path,
                ['http://', 'https://', '//']
            )
        ) {

            $contentFileUrl = $content->file_path;

        } elseif (
            \Illuminate\Support\Str::startsWith(
                $content->file_path,
                'storage/'
            )
        ) {

            $contentFileUrl = asset($content->file_path);

        } elseif (
            \Illuminate\Support\Str::startsWith(
                $content->file_path,
                ['public/', '/public/']
            )
        ) {

            $contentFileUrl = asset(
                'storage/' .
                ltrim(
                    \Illuminate\Support\Str::after(
                        ltrim($content->file_path, '/'),
                        'public/'
                    ),
                    '/'
                )
            );

        } else {

            try {

                $contentFileUrl =
                    \Illuminate\Support\Facades\Storage::disk('public')
                        ->url($content->file_path);

            } catch (\Throwable $e) {

                $contentFileUrl =
                    asset(
                        ltrim(
                            $content->file_path,
                            '/'
                        )
                    );

            }

        }

    }
@endphp


<div class="education-admin-content-create-page">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="education-admin-content-create-header">

        <div class="education-admin-content-create-heading">

            <span class="education-admin-page-header-label">

                <i class="fa-solid fa-eye"></i>

                {{ __('education_admin.lessons.content_show.header_label') }}

            </span>


            <div class="education-admin-content-title-row">

                <div class="education-admin-content-title-icon">

                    @switch($content->type)

                        @case('text')
                            <i class="fa-solid fa-align-right"></i>
                            @break

                        @case('image')
                            <i class="fa-solid fa-image"></i>
                            @break

                        @case('link')
                            <i class="fa-solid fa-link"></i>
                            @break

                        @case('video')
                            <i class="fa-solid fa-video"></i>
                            @break

                        @case('file')
                            <i class="fa-solid fa-file"></i>
                            @break

                        @default
                            <i class="fa-solid fa-layer-group"></i>

                    @endswitch

                </div>


                <div>

                    <h2>
                        {{ $content->title ?: __('education_admin.lessons.content_show.untitled') }}
                    </h2>


                    <span class="education-admin-content-lesson-name">

                        <i class="fa-solid fa-book-open"></i>

                        {{ $lesson->title }}

                    </span>

                </div>

            </div>


            <p>
                {{ __('education_admin.lessons.content_show.description') }}
            </p>

        </div>


        <div class="education-admin-content-header-actions">

            <a
                href="{{ route(
                    'education.admin.lessons.content.index',
                    $lesson
                ) }}"
                class="education-admin-content-back-button"
            >

                <i class="fa-solid fa-arrow-right"></i>

                {{ __('education_admin.lessons.content_show.actions.back') }}

            </a>

        </div>

    </div>


    {{-- =========================================================
        CONTENT GRID
    ========================================================== --}}

    <div class="education-admin-content-form-grid">


        {{-- =====================================================
            MAIN COLUMN
        ====================================================== --}}

        <div class="education-admin-content-form-main">


            {{-- =================================================
                BASIC INFORMATION
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.lessons.content_show.basic_information.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.content_show.basic_information.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">


                    {{-- TITLE / TYPE --}}

                    <div class="education-admin-content-field">

                        <label>
                            {{ __('education_admin.lessons.content_show.basic_information.content_title') }}
                        </label>


                        <div class="education-admin-content-type-display">

                            <div class="education-admin-content-type-icon">

                                @switch($content->type)

                                    @case('text')
                                        <i class="fa-solid fa-align-right"></i>
                                        @break

                                    @case('image')
                                        <i class="fa-solid fa-image"></i>
                                        @break

                                    @case('link')
                                        <i class="fa-solid fa-link"></i>
                                        @break

                                    @case('video')
                                        <i class="fa-solid fa-video"></i>
                                        @break

                                    @case('file')
                                        <i class="fa-solid fa-file"></i>
                                        @break

                                    @default
                                        <i class="fa-solid fa-layer-group"></i>

                                @endswitch

                            </div>


                            <div>

                                <strong>
                                    {{ $content->title ?: __('education_admin.lessons.content_show.untitled') }}
                                </strong>

                                <small>

                                    {{ __('education_admin.lessons.content_show.basic_information.type') }}

                                    @switch($content->type)

                                        @case('text')
                                            {{ __('education_admin.lessons.content_show.types.text') }}
                                            @break

                                        @case('image')
                                            {{ __('education_admin.lessons.content_show.types.image') }}
                                            @break

                                        @case('link')
                                            {{ __('education_admin.lessons.content_show.types.link') }}
                                            @break

                                        @case('video')
                                            {{ __('education_admin.lessons.content_show.types.video') }}
                                            @break

                                        @case('file')
                                            {{ __('education_admin.lessons.content_show.types.file') }}
                                            @break

                                        @default
                                            {{ __('education_admin.lessons.content_show.types.unknown') }}

                                    @endswitch

                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- DESCRIPTION --}}

                    @if($content->description)

                        <div class="education-admin-content-field">

                            <label>
                                {{ __('education_admin.lessons.content_show.basic_information.description') }}
                            </label>

                            <div class="education-admin-content-view-box">

                                {!! nl2br(
                                    e($content->description)
                                ) !!}

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                CONTENT
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon gold">

                        @switch($content->type)

                            @case('text')
                                <i class="fa-solid fa-align-right"></i>
                                @break

                            @case('image')
                                <i class="fa-solid fa-image"></i>
                                @break

                            @case('link')
                                <i class="fa-solid fa-link"></i>
                                @break

                            @case('video')
                                <i class="fa-solid fa-video"></i>
                                @break

                            @case('file')
                                <i class="fa-solid fa-file"></i>
                                @break

                            @default
                                <i class="fa-solid fa-layer-group"></i>

                        @endswitch

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.lessons.content_show.content_section.label') }}
                        </span>

                        <h3>

                            @switch($content->type)

                                @case('text')
                                    {{ __('education_admin.lessons.content_show.types.text') }}
                                    @break

                                @case('image')
                                    {{ __('education_admin.lessons.content_show.types.image') }}
                                    @break

                                @case('link')
                                    {{ __('education_admin.lessons.content_show.types.link') }}
                                    @break

                                @case('video')
                                    {{ __('education_admin.lessons.content_show.types.video') }}
                                    @break

                                @case('file')
                                    {{ __('education_admin.lessons.content_show.types.file') }}
                                    @break

                                @default
                                    {{ __('education_admin.lessons.content_show.types.content') }}

                            @endswitch

                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">


                    {{-- =================================================
                        TEXT
                    ================================================== --}}

                    @if($content->type === 'text')

                        <div class="education-admin-content-field">

                            <label>
                                {{ __('education_admin.lessons.content_show.content_section.text') }}
                            </label>


                            @if($content->content)

                                <div class="education-admin-content-view-box large">

                                    {!! nl2br(
                                        e($content->content)
                                    ) !!}

                                </div>

                            @else

                                <div class="education-admin-content-view-empty">

                                    <i class="fa-solid fa-align-right"></i>

                                    <span>
                                        {{ __('education_admin.lessons.content_show.empty.no_text') }}
                                    </span>

                                </div>

                            @endif

                        </div>

                    @endif


                    {{-- =================================================
                        LINK
                    ================================================== --}}

                    @if($content->type === 'link')

                        <div class="education-admin-content-field">

                            <label>
                                {{ __('education_admin.lessons.content_show.content_section.link') }}
                            </label>


                            @if($content->url)

                                <div class="education-admin-content-url-wrapper">

                                    <i class="fa-solid fa-link"></i>


                                    <a
                                        href="{{ $content->url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="education-admin-content-view-link"
                                    >

                                        {{ $content->url }}

                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                    </a>

                                </div>

                            @else

                                <div class="education-admin-content-view-empty">

                                    <i class="fa-solid fa-link"></i>

                                    <span>
                                        {{ __('education_admin.lessons.content_show.empty.no_link') }}
                                    </span>

                                </div>

                            @endif

                        </div>

                    @endif


                    {{-- =================================================
                        VIDEO
                    ================================================== --}}

                    @if($content->type === 'video')

                        <div class="education-admin-content-field">

                            <label>
                                {{ __('education_admin.lessons.content_show.content_section.video') }}
                            </label>

                            @if($videoEmbedUrl || $videoDirectUrl)

                                <div class="education-admin-content-video-wrapper">

                                    <div class="education-admin-content-video-frame">

                                        @if($videoEmbedUrl)

                                            <iframe
                                                src="{{ $videoEmbedUrl }}"
                                                title="{{ $content->title ?: __('education_admin.lessons.content_show.video.lesson_video') }}"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen
                                                loading="lazy"
                                            ></iframe>

                                        @else

                                            <video
                                                controls
                                                preload="metadata"
                                                playsinline
                                            >

                                                <source src="{{ $videoDirectUrl }}">

                                                {{ __('education_admin.lessons.content_show.video.not_supported') }}

                                            </video>

                                        @endif

                                    </div>

                                    <div class="education-admin-content-video-info">

                                        <a
                                            href="{{ $content->url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                        >

                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                            {{ __('education_admin.lessons.content_show.video.open_original') }}

                                        </a>

                                    </div>

                                </div>

                            @elseif($content->url)

                                <div class="education-admin-content-url-wrapper">

                                    <i class="fa-solid fa-video"></i>

                                    <a
                                        href="{{ $content->url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="education-admin-content-view-link"
                                    >

                                        {{ $content->url }}

                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>

                                    </a>

                                </div>

                            @else

                                <div class="education-admin-content-view-empty">

                                    <i class="fa-solid fa-video-slash"></i>

                                    <span>
                                        {{ __('education_admin.lessons.content_show.empty.no_video') }}
                                    </span>

                                </div>

                            @endif

                        </div>

                    @endif


                    {{-- =================================================
                        IMAGE
                    ================================================== --}}

                    @if($content->type === 'image')

                        @if($content->file_path && $contentFileUrl)

                            <div class="education-admin-content-field">

                                <label>
                                    {{ __('education_admin.lessons.content_show.content_section.image') }}
                                </label>


                                <div class="education-admin-content-current-file">

                                    <div class="education-admin-content-current-file-header">

                                        <span>

                                            <i class="fa-solid fa-image"></i>

                                            {{ __('education_admin.lessons.content_show.image.content_image') }}

                                        </span>

                                    </div>


                                    <div class="education-admin-content-current-image">

                                        <img
                                            src="{{ $contentFileUrl }}"
                                            alt="{{ $content->title ?: __('education_admin.lessons.content_show.image.alt') }}"
                                        >

                                    </div>


                                    <div class="education-admin-content-current-file-info">

                                        <strong>

                                            {{ $content->file_name ?: __('education_admin.lessons.content_show.image.current') }}

                                        </strong>


                                        @if($content->file_size)

                                            <span>

                                                {{ number_format(
                                                    $content->file_size / 1024,
                                                    1
                                                ) }}

                                                KB

                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @else

                            <div class="education-admin-content-view-empty">

                                <i class="fa-solid fa-image"></i>

                                <span>
                                    {{ __('education_admin.lessons.content_show.empty.no_image') }}
                                </span>

                            </div>

                        @endif

                    @endif


                    {{-- =================================================
                        FILE
                    ================================================== --}}

                    @if($content->type === 'file')

                        @if($content->file_path && $contentFileUrl)

                            <div class="education-admin-content-field">

                                <label>
                                    {{ __('education_admin.lessons.content_show.content_section.file') }}
                                </label>


                                <div class="education-admin-content-current-file">

                                    <div class="education-admin-content-current-file-header">

                                        <span>

                                            <i class="fa-solid fa-file"></i>

                                            {{ __('education_admin.lessons.content_show.file.content_file') }}

                                        </span>

                                    </div>


                                    <div class="education-admin-content-current-file-row">

                                        <div class="education-admin-content-current-file-icon">

                                            <i class="fa-solid fa-file-lines"></i>

                                        </div>


                                        <div>

                                            <strong>

                                                {{ $content->file_name ?: __('education_admin.lessons.content_show.file.current') }}

                                            </strong>


                                            <span>

                                                {{ $content->mime_type ?: __('education_admin.lessons.content_show.file.file') }}

                                                @if($content->file_size)

                                                    ·

                                                    {{ number_format(
                                                        $content->file_size / 1024,
                                                        1
                                                    ) }}

                                                    KB

                                                @endif

                                            </span>

                                        </div>


                                        <a
                                            href="{{ $contentFileUrl }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="education-admin-content-current-file-view"
                                        >

                                            <i class="fa-solid fa-eye"></i>

                                            {{ __('education_admin.lessons.content_show.file.view') }}

                                        </a>

                                    </div>

                                </div>

                            </div>

                        @else

                            <div class="education-admin-content-view-empty">

                                <i class="fa-solid fa-file"></i>

                                <span>
                                    {{ __('education_admin.lessons.content_show.empty.no_file') }}
                                </span>

                            </div>

                        @endif

                    @endif


                    {{-- UNKNOWN TYPE --}}

                    @if(
                        !in_array(
                            $content->type,
                            ['text', 'image', 'link', 'video', 'file']
                        )
                    )

                        <div class="education-admin-content-view-empty">

                            <i class="fa-solid fa-circle-question"></i>

                            <span>
                                {{ __('education_admin.lessons.content_show.empty.unknown_type') }}
                            </span>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                DISPLAY SETTINGS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-sliders"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.lessons.content_show.settings.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.content_show.settings.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-body">

                    <div class="education-admin-content-settings-grid">


                        {{-- SORT ORDER --}}

                        <div class="education-admin-content-field">

                            <label>
                                {{ __('education_admin.lessons.content_show.settings.sort_order') }}
                            </label>


                            <div class="education-admin-content-view-value">

                                {{ $content->sort_order ?? 0 }}

                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div class="education-admin-content-status-box">

                            <label>
                                {{ __('education_admin.lessons.content_show.settings.status') }}
                            </label>


                            <div class="education-admin-content-status-display">

                                @if($content->is_active)

                                    <span class="education-admin-content-status active">

                                        <i class="fa-solid fa-circle-check"></i>

                                        {{ __('education_admin.lessons.content_show.settings.active') }}

                                    </span>

                                @else

                                    <span class="education-admin-content-status inactive">

                                        <i class="fa-solid fa-circle-xmark"></i>

                                        {{ __('education_admin.lessons.content_show.settings.inactive') }}

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <aside class="education-admin-content-form-sidebar">


            {{-- =================================================
                CONTENT TYPE
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon gold">

                        <i class="fa-solid fa-layer-group"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.lessons.content_show.type_card.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.content_show.type_card.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-type-summary">

                    <div class="education-admin-content-type-summary-icon">

                        @switch($content->type)

                            @case('text')
                                <i class="fa-solid fa-align-right"></i>
                                @break

                            @case('image')
                                <i class="fa-solid fa-image"></i>
                                @break

                            @case('link')
                                <i class="fa-solid fa-link"></i>
                                @break

                            @case('video')
                                <i class="fa-solid fa-video"></i>
                                @break

                            @case('file')
                                <i class="fa-solid fa-file"></i>
                                @break

                            @default
                                <i class="fa-solid fa-layer-group"></i>

                        @endswitch

                    </div>


                    <strong>

                        @switch($content->type)

                            @case('text')
                                {{ __('education_admin.lessons.content_show.type_card.text') }}
                                @break

                            @case('image')
                                {{ __('education_admin.lessons.content_show.type_card.image') }}
                                @break

                            @case('link')
                                {{ __('education_admin.lessons.content_show.type_card.link') }}
                                @break

                            @case('video')
                                {{ __('education_admin.lessons.content_show.type_card.video') }}
                                @break

                            @case('file')
                                {{ __('education_admin.lessons.content_show.type_card.file') }}
                                @break

                            @default
                                {{ __('education_admin.lessons.content_show.type_card.unknown') }}

                        @endswitch

                    </strong>

                </div>

            </div>


            {{-- =================================================
                ACTIONS
            ================================================== --}}

            <div class="education-admin-content-form-card">

                <div class="education-admin-content-form-card-header">

                    <div class="education-admin-content-form-card-icon green">

                        <i class="fa-solid fa-gears"></i>

                    </div>


                    <div>

                        <span>
                            {{ __('education_admin.lessons.content_show.actions_card.label') }}
                        </span>

                        <h3>
                            {{ __('education_admin.lessons.content_show.actions_card.title') }}
                        </h3>

                    </div>

                </div>


                <div class="education-admin-content-form-actions">

                    <a
                        href="{{ route(
                            'education.admin.lessons.content.edit',
                            [$lesson, $content]
                        ) }}"
                        class="education-admin-content-submit-button"
                    >

                        <i class="fa-solid fa-pen-to-square"></i>

                        {{ __('education_admin.lessons.content_show.actions.edit') }}

                    </a>


                    <a
                        href="{{ route(
                            'education.admin.lessons.content.index',
                            $lesson
                        ) }}"
                        class="education-admin-content-cancel-button"
                    >

                        <i class="fa-solid fa-arrow-right"></i>

                        {{ __('education_admin.lessons.content_show.actions.back') }}

                    </a>

                </div>

            </div>


            {{-- =================================================
                DELETE
            ================================================== --}}

            <div class="education-admin-content-delete-card">

                <div class="education-admin-content-delete-icon">

                    <i class="fa-solid fa-trash"></i>

                </div>


                <div>

                    <strong>
                        {{ __('education_admin.lessons.content_show.delete.title') }}
                    </strong>

                    <p>
                        {{ __('education_admin.lessons.content_show.delete.description') }}
                    </p>

                </div>


                <form
                    action="{{ route(
                        'education.admin.lessons.content.destroy',
                        [$lesson, $content]
                    ) }}"
                    method="POST"
                    onsubmit="return confirm('{{ __('education_admin.lessons.content_show.delete.confirm') }}');"
                >

                    @csrf

                    @method('DELETE')


                    <button
                        type="submit"
                        class="education-admin-content-delete-button"
                    >

                        <i class="fa-solid fa-trash"></i>

                        {{ __('education_admin.lessons.content_show.delete.button') }}

                    </button>

                </form>

            </div>


            {{-- =================================================
                INFO
            ================================================== --}}

            <div class="education-admin-content-note">

                <div class="education-admin-content-note-icon">

                    <i class="fa-solid fa-lightbulb"></i>

                </div>


                <div>

                    <strong>
                        {{ __('education_admin.lessons.content_show.note.title') }}
                    </strong>

                    <p>
                        {{ __('education_admin.lessons.content_show.note.description') }}
                    </p>

                </div>

            </div>

        </aside>

    </div>

</div>

@endsection
