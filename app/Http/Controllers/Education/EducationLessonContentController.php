<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationLesson;
use App\Models\EducationLessonContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class EducationLessonContentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | إدارة محتوى درس محدد
    |--------------------------------------------------------------------------
    */

    public function index(EducationLesson $lesson)
    {
        $contents = $lesson->contents()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $statistics = [
            'total' => $contents->count(),

            'text' => $contents
                ->where('type', 'text')
                ->count(),

            'image' => $contents
                ->where('type', 'image')
                ->count(),

            'link' => $contents
                ->where('type', 'link')
                ->count(),

            'file' => $contents
                ->where('type', 'file')
                ->count(),

            'video' => $contents
                ->where('type', 'video')
                ->count(),
        ];

        return view(
            'education.admin.lessons.content',
            compact(
                'lesson',
                'contents',
                'statistics'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(EducationLesson $lesson)
    {
        return view(
            'education.admin.lessons.content-create',
            compact('lesson')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    | إضافة عدة عناصر محتوى دفعة واحدة
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        EducationLesson $lesson
    ) {
        /*
        |--------------------------------------------------------------------------
        | BASIC VALIDATION
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'contents' => [
                'required',
                'array',
                'min:1',
            ],

            'contents.*.type' => [
                'required',
                'in:text,image,link,file,video',
            ],

            'contents.*.title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'contents.*.description' => [
                'nullable',
                'string',
            ],

            'contents.*.content' => [
                'nullable',
                'string',
            ],

            'contents.*.url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'contents.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'contents.*.is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | TYPE-SPECIFIC VALIDATION
        |--------------------------------------------------------------------------
        */

        foreach (
            $request->input('contents', []) as $index => $item
        ) {
            $type = $item['type'] ?? null;


            /*
            |--------------------------------------------------------------------------
            | TEXT
            |--------------------------------------------------------------------------
            */

            if ($type === 'text') {

                $request->validate([
                    "contents.$index.content" => [
                        'required',
                        'string',
                    ],
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | LINK
            |--------------------------------------------------------------------------
            */

            if ($type === 'link') {

                $request->validate([
                    "contents.$index.url" => [
                        'required',
                        'url',
                        'max:2048',
                    ],
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | VIDEO
            |--------------------------------------------------------------------------
            | الفيديو يتم حفظه كرابط فقط.
            | لا يتم رفع الفيديو إلى الموقع.
            |
            | الروابط المدعومة:
            | - YouTube
            | - Google Drive
            | - أي رابط فيديو خارجي صالح
            |--------------------------------------------------------------------------
            */

            if ($type === 'video') {

                $request->validate([
                    "contents.$index.url" => [
                        'required',
                        'url',
                        'max:2048',
                    ],
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | IMAGE
            |--------------------------------------------------------------------------
            */

            if ($type === 'image') {

                $request->validate([
                    "contents.$index.upload" => [
                        'required',
                        'file',
                        'mimes:jpg,jpeg,png,webp,gif',
                        'max:10240',
                    ],
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | FILE
            |--------------------------------------------------------------------------
            */

            if ($type === 'file') {

                $request->validate([
                    "contents.$index.upload" => [
                        'required',
                        'file',
                        'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip',
                        'max:51200',
                    ],
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE CONTENTS
        |--------------------------------------------------------------------------
        */

        $createdFiles = [];

        try {

            DB::transaction(function () use (
                $request,
                $lesson,
                &$createdFiles
            ) {

                /*
                |--------------------------------------------------------------------------
                | START SORT ORDER
                |--------------------------------------------------------------------------
                */

                $nextSortOrder = $this->getNextSortOrder(
                    $lesson
                );


                /*
                |--------------------------------------------------------------------------
                | LOOP THROUGH CONTENTS
                |--------------------------------------------------------------------------
                */

                foreach (
                    $request->input('contents', []) as $index => $item
                ) {

                    $type = $item['type'];


                    /*
                    |--------------------------------------------------------------------------
                    | BASIC DATA
                    |--------------------------------------------------------------------------
                    */

                    $data = [

                        'education_lesson_id' =>
                            $lesson->id,

                        'type' =>
                            $type,

                        'title' =>
                            $item['title'] ?? null,

                        'description' =>
                            $item['description'] ?? null,

                        'content' =>
                            $item['content'] ?? null,

                        'url' =>
                            $item['url'] ?? null,

                        'sort_order' =>
                            isset($item['sort_order'])
                                ? (int) $item['sort_order']
                                : $nextSortOrder,

                        'is_active' =>
                            filter_var(
                                $item['is_active'] ?? true,
                                FILTER_VALIDATE_BOOLEAN
                            ),
                    ];


                    /*
                    |--------------------------------------------------------------------------
                    | FILE / IMAGE UPLOAD
                    |--------------------------------------------------------------------------
                    |
                    | الفيديو مستثنى هنا لأنه رابط خارجي فقط.
                    |--------------------------------------------------------------------------
                    */

                    if (
                        in_array(
                            $type,
                            ['image', 'file'],
                            true
                        )
                    ) {

                        $upload = $this->handleMultipleUpload(
                            $request,
                            $index,
                            $type,
                            $lesson
                        );


                        $data = array_merge(
                            $data,
                            $upload
                        );


                        /*
                        |--------------------------------------------------------------------------
                        | REMEMBER CREATED FILE
                        |--------------------------------------------------------------------------
                        */

                        if (
                            !empty(
                                $upload['file_path']
                            )
                        ) {

                            $createdFiles[] =
                                $upload['file_path'];
                        }
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | CREATE DATABASE RECORD
                    |--------------------------------------------------------------------------
                    */

                    EducationLessonContent::create(
                        $data
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | NEXT SORT ORDER
                    |--------------------------------------------------------------------------
                    */

                    $nextSortOrder++;
                }
            });

        } catch (Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | CLEANUP CREATED FILES
            |--------------------------------------------------------------------------
            */

            foreach (
                $createdFiles as $filePath
            ) {

                $this->deleteFilePath(
                    $filePath
                );
            }


            throw $e;
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.lessons.content.index',
                $lesson
            )
            ->with(
                'success',
                'تمت إضافة محتوى الدرس بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        EducationLesson $lesson,
        EducationLessonContent $content
    ) {
        $this->ensureContentBelongsToLesson(
            $lesson,
            $content
        );

        return view(
            'education.admin.lessons.content-show',
            compact(
                'lesson',
                'content'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(
        EducationLesson $lesson,
        EducationLessonContent $content
    ) {
        $this->ensureContentBelongsToLesson(
            $lesson,
            $content
        );

        return view(
            'education.admin.lessons.content-edit',
            compact(
                'lesson',
                'content'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    | تحديث عنصر محتوى واحد
    |--------------------------------------------------------------------------
    |
    | يسمح بتغيير نوع المحتوى بعد إنشائه.
    |
    */

    public function update(
        Request $request,
        EducationLesson $lesson,
        EducationLessonContent $content
    ) {
        $this->ensureContentBelongsToLesson(
            $lesson,
            $content
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDATE BASIC DATA
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'type' => [
                'required',
                'in:text,image,link,file,video',
            ],

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'content' => [
                'nullable',
                'string',
            ],

            'url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | NEW TYPE
        |--------------------------------------------------------------------------
        */

        $newType =
            $validated['type'];


        /*
        |--------------------------------------------------------------------------
        | OLD TYPE
        |--------------------------------------------------------------------------
        */

        $oldType =
            $content->type;


        /*
        |--------------------------------------------------------------------------
        | TYPE-SPECIFIC VALIDATION
        |--------------------------------------------------------------------------
        */

        $this->validateUpdateTypeSpecificData(
            $request,
            $newType,
            $oldType
        );


        /*
        |--------------------------------------------------------------------------
        | DEFAULT VALUES
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean(
                'is_active'
            );

        $validated['sort_order'] =
            $validated['sort_order']
            ?? $content->sort_order;


        /*
        |--------------------------------------------------------------------------
        | OLD FILE INFORMATION
        |--------------------------------------------------------------------------
        */

        $oldFilePath =
            $content->file_path;


        /*
        |--------------------------------------------------------------------------
        | OLD FILE TYPE
        |--------------------------------------------------------------------------
        */

        $oldHasFile =
            in_array(
                $oldType,
                ['image', 'file'],
                true
            );


        /*
        |--------------------------------------------------------------------------
        | NEW FILE TYPE
        |--------------------------------------------------------------------------
        */

        $newHasFile =
            in_array(
                $newType,
                ['image', 'file'],
                true
            );


        /*
        |--------------------------------------------------------------------------
        | TYPE CHANGED
        |--------------------------------------------------------------------------
        */

        $typeChanged =
            $oldType !== $newType;


        /*
        |--------------------------------------------------------------------------
        | NEW FILE PATH
        |--------------------------------------------------------------------------
        */

        $newFilePath = null;


        try {

            /*
            |--------------------------------------------------------------------------
            | HANDLE NEW IMAGE / FILE
            |--------------------------------------------------------------------------
            */

            if ($newHasFile) {

                if (
                    $request->hasFile('upload')
                ) {

                    $upload =
                        $this->handleUpload(
                            $request,
                            $newType,
                            $lesson
                        );


                    if (
                        !empty(
                            $upload['file_path']
                        )
                    ) {

                        $newFilePath =
                            $upload['file_path'];
                    }


                    $validated =
                        array_merge(
                            $validated,
                            $upload
                        );
                }
            }


            /*
            |--------------------------------------------------------------------------
            | TYPE CHANGED TO IMAGE / FILE
            |--------------------------------------------------------------------------
            */

            if (
                $typeChanged &&
                $newHasFile &&
                !$newFilePath
            ) {

                throw new \RuntimeException(
                    'يجب رفع صورة أو ملف جديد عند تغيير نوع المحتوى.'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | TYPE CHANGED TO VIDEO
            |--------------------------------------------------------------------------
            |
            | الفيديو يحتاج رابطًا فقط.
            |--------------------------------------------------------------------------
            */

            if (
                $newType === 'video'
            ) {

                $validated['file_path'] = null;
                $validated['file_name'] = null;
                $validated['mime_type'] = null;
                $validated['file_size'] = null;
            }


            /*
            |--------------------------------------------------------------------------
            | TYPE CHANGED AWAY FROM FILE TYPE
            |--------------------------------------------------------------------------
            */

            if (
                !$newHasFile
            ) {

                $validated['file_path'] = null;
                $validated['file_name'] = null;
                $validated['mime_type'] = null;
                $validated['file_size'] = null;
            }


            /*
            |--------------------------------------------------------------------------
            | CLEAN CONTENT BASED ON NEW TYPE
            |--------------------------------------------------------------------------
            */

            if ($newType !== 'text') {

                $validated['content'] = null;
            }


            /*
            |--------------------------------------------------------------------------
            | CLEAN URL BASED ON NEW TYPE
            |--------------------------------------------------------------------------
            */

            if (
                !in_array(
                    $newType,
                    ['link', 'video'],
                    true
                )
            ) {

                $validated['url'] = null;
            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE DATABASE
            |--------------------------------------------------------------------------
            */

            DB::transaction(function () use (
                $content,
                $validated
            ) {

                $content->update(
                    $validated
                );
            });


            /*
            |--------------------------------------------------------------------------
            | DELETE OLD FILE
            |--------------------------------------------------------------------------
            */

            $shouldDeleteOldFile =
                $oldFilePath
                &&
                (
                    !$newHasFile
                    ||
                    (
                        $newFilePath
                        &&
                        $oldFilePath !== $newFilePath
                    )
                );


            if (
                $shouldDeleteOldFile
            ) {

                $this->deleteFilePath(
                    $oldFilePath
                );
            }

        } catch (Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | CLEANUP NEW FILE
            |--------------------------------------------------------------------------
            */

            if (
                $newFilePath
            ) {

                $this->deleteFilePath(
                    $newFilePath
                );
            }


            Log::error(
                'Failed to update education lesson content.',
                [
                    'lesson_id' =>
                        $lesson->id,

                    'content_id' =>
                        $content->id,

                    'old_type' =>
                        $oldType,

                    'new_type' =>
                        $newType,

                    'error' =>
                        $e->getMessage(),
                ]
            );


            throw $e;
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.lessons.content.index',
                $lesson
            )
            ->with(
                'success',
                'تم تحديث محتوى الدرس بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    */

    public function toggleStatus(
        EducationLesson $lesson,
        EducationLessonContent $content
    ) {
        $this->ensureContentBelongsToLesson(
            $lesson,
            $content
        );


        $content->update([
            'is_active' =>
                ! $content->is_active,
        ]);


        return back()
            ->with(
                'success',
                $content->is_active
                    ? 'تم تفعيل المحتوى بنجاح.'
                    : 'تم تعطيل المحتوى بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        EducationLesson $lesson,
        EducationLessonContent $content
    ) {
        $this->ensureContentBelongsToLesson(
            $lesson,
            $content
        );


        /*
        |--------------------------------------------------------------------------
        | SAVE FILE PATH BEFORE DELETE
        |--------------------------------------------------------------------------
        */

        $filePath =
            $content->file_path;


        /*
        |--------------------------------------------------------------------------
        | DELETE DATABASE RECORD FIRST
        |--------------------------------------------------------------------------
        */

        $content->delete();


        /*
        |--------------------------------------------------------------------------
        | DELETE PHYSICAL FILE
        |--------------------------------------------------------------------------
        */

        if (
            $filePath
        ) {

            $this->deleteFilePath(
                $filePath
            );
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.lessons.content.index',
                $lesson
            )
            ->with(
                'success',
                'تم حذف محتوى الدرس بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | REORDER
    |--------------------------------------------------------------------------
    */

    public function reorder(
        Request $request,
        EducationLesson $lesson
    ) {
        $validated = $request->validate([
            'contents' => [
                'required',
                'array',
            ],

            'contents.*' => [
                'integer',
            ],
        ]);


        foreach (
            $validated['contents'] as $index => $contentId
        ) {

            EducationLessonContent::query()
                ->where(
                    'id',
                    $contentId
                )
                ->where(
                    'education_lesson_id',
                    $lesson->id
                )
                ->update([
                    'sort_order' =>
                        $index,
                ]);
        }


        return response()->json([
            'success' => true,

            'message' =>
                'تم تحديث ترتيب المحتوى بنجاح.',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | VALIDATE UPDATE TYPE-SPECIFIC DATA
    |--------------------------------------------------------------------------
    */

    private function validateUpdateTypeSpecificData(
        Request $request,
        string $newType,
        string $oldType
    ): void {

        /*
        |--------------------------------------------------------------------------
        | TEXT
        |--------------------------------------------------------------------------
        */

        if ($newType === 'text') {

            $request->validate([
                'content' => [
                    'required',
                    'string',
                ],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | LINK
        |--------------------------------------------------------------------------
        */

        if ($newType === 'link') {

            $request->validate([
                'url' => [
                    'required',
                    'url',
                    'max:2048',
                ],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | VIDEO
        |--------------------------------------------------------------------------
        | الفيديو رابط خارجي فقط.
        |--------------------------------------------------------------------------
        */

        if ($newType === 'video') {

            $request->validate([
                'url' => [
                    'required',
                    'url',
                    'max:2048',
                ],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | IMAGE
        |--------------------------------------------------------------------------
        */

        if ($newType === 'image') {

            $rules = [
                'file',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:10240',
            ];


            if (
                $oldType === 'image'
            ) {

                array_unshift(
                    $rules,
                    'nullable'
                );

            } else {

                array_unshift(
                    $rules,
                    'required'
                );
            }


            $request->validate([
                'upload' => $rules,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | FILE
        |--------------------------------------------------------------------------
        */

        if ($newType === 'file') {

            $rules = [
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip',
                'max:51200',
            ];


            if (
                $oldType === 'file'
            ) {

                array_unshift(
                    $rules,
                    'nullable'
                );

            } else {

                array_unshift(
                    $rules,
                    'required'
                );
            }


            $request->validate([
                'upload' => $rules,
            ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | HANDLE MULTIPLE UPLOAD
    |--------------------------------------------------------------------------
    | رفع صورة / ملف من داخل contents[index]
    |--------------------------------------------------------------------------
    */

    private function handleMultipleUpload(
        Request $request,
        int $index,
        string $type,
        EducationLesson $lesson
    ): array {

        $file = $request->file(
            "contents.$index.upload"
        );


        if (!$file) {
            return [];
        }


        /*
        |--------------------------------------------------------------------------
        | READ FILE INFORMATION
        |--------------------------------------------------------------------------
        */

        $originalName =
            $file->getClientOriginalName();

        $mimeType =
            $file->getClientMimeType();

        $fileSize =
            $file->getSize();

        $extension =
            strtolower(
                $file->getClientOriginalExtension()
            );


        /*
        |--------------------------------------------------------------------------
        | DIRECTORY
        |--------------------------------------------------------------------------
        */

        $directory = $this->getUploadDirectory(
            $lesson,
            $type
        );


        /*
        |--------------------------------------------------------------------------
        | CREATE DIRECTORY
        |--------------------------------------------------------------------------
        */

        if (
            !File::exists(
                $directory
            )
        ) {

            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }


        /*
        |--------------------------------------------------------------------------
        | UNIQUE FILE NAME
        |--------------------------------------------------------------------------
        */

        $filename =
            $this->generateFileName(
                $originalName,
                $type,
                $extension
            );


        /*
        |--------------------------------------------------------------------------
        | MOVE
        |--------------------------------------------------------------------------
        */

        $file->move(
            $directory,
            $filename
        );


        /*
        |--------------------------------------------------------------------------
        | RELATIVE DIRECTORY
        |--------------------------------------------------------------------------
        */

        $relativeDirectory =
            $this->getRelativeUploadDirectory(
                $lesson,
                $type
            );


        /*
        |--------------------------------------------------------------------------
        | RETURN DATA
        |--------------------------------------------------------------------------
        */

        return [
            'file_path' =>
                $relativeDirectory .
                $filename,

            'file_name' =>
                $originalName,

            'mime_type' =>
                $mimeType,

            'file_size' =>
                $fileSize,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | HANDLE SINGLE UPLOAD
    |--------------------------------------------------------------------------
    */

    private function handleUpload(
        Request $request,
        string $type,
        EducationLesson $lesson
    ): array {

        if (
            !$request->hasFile('upload')
        ) {

            return [];
        }


        $file =
            $request->file('upload');


        /*
        |--------------------------------------------------------------------------
        | READ FILE INFORMATION
        |--------------------------------------------------------------------------
        */

        $originalName =
            $file->getClientOriginalName();

        $mimeType =
            $file->getClientMimeType();

        $fileSize =
            $file->getSize();

        $extension =
            strtolower(
                $file->getClientOriginalExtension()
            );


        /*
        |--------------------------------------------------------------------------
        | DIRECTORY
        |--------------------------------------------------------------------------
        */

        $directory =
            $this->getUploadDirectory(
                $lesson,
                $type
            );


        /*
        |--------------------------------------------------------------------------
        | CREATE DIRECTORY
        |--------------------------------------------------------------------------
        */

        if (
            !File::exists(
                $directory
            )
        ) {

            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }


        /*
        |--------------------------------------------------------------------------
        | UNIQUE FILE NAME
        |--------------------------------------------------------------------------
        */

        $filename =
            $this->generateFileName(
                $originalName,
                $type,
                $extension
            );


        /*
        |--------------------------------------------------------------------------
        | MOVE
        |--------------------------------------------------------------------------
        */

        $file->move(
            $directory,
            $filename
        );


        /*
        |--------------------------------------------------------------------------
        | RELATIVE DIRECTORY
        |--------------------------------------------------------------------------
        */

        $relativeDirectory =
            $this->getRelativeUploadDirectory(
                $lesson,
                $type
            );


        /*
        |--------------------------------------------------------------------------
        | RETURN DATA
        |--------------------------------------------------------------------------
        */

        return [
            'file_path' =>
                $relativeDirectory .
                $filename,

            'file_name' =>
                $originalName,

            'mime_type' =>
                $mimeType,

            'file_size' =>
                $fileSize,
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | GET UPLOAD DIRECTORY
    |--------------------------------------------------------------------------
    */

    private function getUploadDirectory(
        EducationLesson $lesson,
        string $type
    ): string {

        $folder = match ($type) {

            'image' => 'images',

            default => 'files',
        };


        return public_path(
            'images/education/lessons/' .
            $lesson->id .
            '/' .
            $folder
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GET RELATIVE UPLOAD DIRECTORY
    |--------------------------------------------------------------------------
    */

    private function getRelativeUploadDirectory(
        EducationLesson $lesson,
        string $type
    ): string {

        $folder = match ($type) {

            'image' => 'images',

            default => 'files',
        };


        return
            'images/education/lessons/' .
            $lesson->id .
            '/' .
            $folder .
            '/';
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE FILE NAME
    |--------------------------------------------------------------------------
    */

    private function generateFileName(
        string $originalName,
        string $type,
        string $extension
    ): string {

        $baseName =
            Str::slug(
                pathinfo(
                    $originalName,
                    PATHINFO_FILENAME
                )
            );


        if (
            empty($baseName)
        ) {

            $baseName = match ($type) {

                'image' => 'image',

                default => 'file',
            };
        }


        return
            $baseName .
            '-' .
            Str::lower(
                Str::random(8)
            ) .
            '.' .
            $extension;
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE UPLOAD
    |--------------------------------------------------------------------------
    */

    private function deleteUpload(
        EducationLessonContent $content
    ): void {

        if (
            empty(
                $content->file_path
            )
        ) {

            return;
        }


        $this->deleteFilePath(
            $content->file_path
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE FILE PATH
    |--------------------------------------------------------------------------
    */

    private function deleteFilePath(
        ?string $filePath
    ): bool {

        if (
            empty($filePath)
        ) {

            return false;
        }


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE PATH
        |--------------------------------------------------------------------------
        */

        $filePath =
            ltrim(
                str_replace(
                    ['\\', '//'],
                    '/',
                    $filePath
                ),
                '/'
            );


        /*
        |--------------------------------------------------------------------------
        | ABSOLUTE PATH
        |--------------------------------------------------------------------------
        */

        $absolutePath =
            public_path(
                $filePath
            );


        /*
        |--------------------------------------------------------------------------
        | DELETE FILE
        |--------------------------------------------------------------------------
        */

        if (
            File::exists(
                $absolutePath
            )
        ) {

            try {

                File::delete(
                    $absolutePath
                );

                return true;

            } catch (Throwable $e) {

                Log::error(
                    'Failed to delete education lesson content file.',
                    [
                        'file_path' =>
                            $filePath,

                        'absolute_path' =>
                            $absolutePath,

                        'error' =>
                            $e->getMessage(),
                    ]
                );

                return false;
            }
        }


        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | NEXT SORT ORDER
    |--------------------------------------------------------------------------
    */

    private function getNextSortOrder(
        EducationLesson $lesson
    ): int {

        return (
            (int) $lesson
                ->contents()
                ->max('sort_order')
        ) + 1;
    }


    /*
    |--------------------------------------------------------------------------
    | ENSURE CONTENT BELONGS TO LESSON
    |--------------------------------------------------------------------------
    */

    private function ensureContentBelongsToLesson(
        EducationLesson $lesson,
        EducationLessonContent $content
    ): void {

        abort_unless(
            $content->education_lesson_id === $lesson->id,
            404
        );
    }
}
