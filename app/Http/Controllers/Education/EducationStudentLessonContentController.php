<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationLessonContent;
use App\Models\EducationStudentLesson;
use App\Models\EducationStudentLessonContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class EducationStudentLessonContentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(EducationStudentLesson $studentLesson)
    {
        $studentLesson->load([
            'student',
            'sourceLesson',
            'contents' => function ($query) {
                $query
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },
        ]);

        $contents = $studentLesson->contents;

        $sourceContents = collect();

        if ($studentLesson->sourceLesson) {

            $sourceContents = EducationLessonContent::query()
                ->where(
                    'education_lesson_id',
                    $studentLesson->sourceLesson->id
                )
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();
        }

        $copiedSourceIds = $contents
            ->pluck('source_content_id')
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->values();

        return view(
            'education.admin.student-lessons.content.index',
            compact(
                'studentLesson',
                'contents',
                'sourceContents',
                'copiedSourceIds'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create(EducationStudentLesson $studentLesson)
    {
        $studentLesson->load([
            'student',
            'sourceLesson',
        ]);

        $sourceContents = collect();

        if ($studentLesson->sourceLesson) {

            $sourceContents = EducationLessonContent::query()
                ->where(
                    'education_lesson_id',
                    $studentLesson->sourceLesson->id
                )
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();
        }

        $copiedSourceIds = EducationStudentLessonContent::query()
            ->where(
                'education_student_lesson_id',
                $studentLesson->id
            )
            ->whereNotNull('source_content_id')
            ->pluck('source_content_id')
            ->map(fn ($id) => (int) $id)
            ->values();

        return view(
            'education.admin.student-lessons.content.create',
            compact(
                'studentLesson',
                'sourceContents',
                'copiedSourceIds'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        EducationStudentLesson $studentLesson
    ) {
        $validated = $request->validate([

            'source_content_id' => [
                'nullable',
                'integer',
                'exists:education_lesson_contents,id',
            ],

            'type' => [
                'required',
                'string',
                'in:text,image,link,file',
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
                'string',
                'max:2048',
            ],

            'file' => [
                'nullable',
                'file',
                'max:20480',
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


        $sourceContent = null;

        if (!empty($validated['source_content_id'])) {

            $sourceContent = EducationLessonContent::query()
                ->findOrFail(
                    $validated['source_content_id']
                );

            if (
                !$studentLesson->sourceLesson ||
                (int) $sourceContent->education_lesson_id !==
                (int) $studentLesson->sourceLesson->id
            ) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'source_content_id' =>
                            'The selected content does not belong to the source lesson.',
                    ]);
            }


            $alreadyExists = EducationStudentLessonContent::query()
                ->where(
                    'education_student_lesson_id',
                    $studentLesson->id
                )
                ->where(
                    'source_content_id',
                    $sourceContent->id
                )
                ->exists();

            if ($alreadyExists) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'source_content_id' =>
                            'This content has already been added to this student lesson.',
                    ]);
            }
        }


        DB::beginTransaction();

        try {

            $data = [

                'education_student_lesson_id' =>
                    $studentLesson->id,

                'source_content_id' =>
                    $sourceContent?->id
                    ?? ($validated['source_content_id'] ?? null),

                'type' =>
                    $sourceContent?->type
                    ?? $validated['type'],

                'title' =>
                    $sourceContent?->title
                    ?? ($validated['title'] ?? null),

                'description' =>
                    $sourceContent?->description
                    ?? ($validated['description'] ?? null),

                'content' =>
                    $sourceContent?->content
                    ?? ($validated['content'] ?? null),

                'url' =>
                    $sourceContent?->url
                    ?? ($validated['url'] ?? null),

                'sort_order' =>
                    $validated['sort_order']
                    ?? $this->getNextSortOrder($studentLesson),

                'is_active' =>
                    array_key_exists('is_active', $validated)
                        ? (bool) $validated['is_active']
                        : true,
            ];


            if ($sourceContent) {

                $data['file_path'] =
                    $sourceContent->file_path;

                $data['file_name'] =
                    $sourceContent->file_name;

                $data['mime_type'] =
                    $sourceContent->mime_type;

                $data['file_size'] =
                    $sourceContent->file_size;
            }


            if ($request->hasFile('file')) {

                $fileData =
                    $this->storeUploadedFile(
                        $request->file('file')
                    );

                $data = array_merge(
                    $data,
                    $fileData
                );
            }


            EducationStudentLessonContent::create($data);

            DB::commit();

            return redirect()
                ->route(
                    'education.admin.student-lessons.content.index',
                    $studentLesson
                )
                ->with(
                    'success',
                    'Student lesson content added successfully.'
                );

        } catch (Throwable $e) {

            DB::rollBack();

            Log::error(
                'Failed to create student lesson content.',
                [
                    'student_lesson_id' =>
                        $studentLesson->id,

                    'error' =>
                        $e->getMessage(),

                    'trace' =>
                        $e->getTraceAsString(),
                ]
            );

            return back()
                ->withInput()
                ->withErrors([
                    'content' =>
                        'Unable to add the content. Please try again.',
                ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        EducationStudentLesson $studentLesson,
        EducationStudentLessonContent $content
    ) {
        $this->ensureContentBelongsToStudentLesson(
            $content,
            $studentLesson
        );

        $studentLesson->load([
            'student',
            'sourceLesson',
        ]);

        $content->load([
            'sourceContent',
        ]);

        return view(
            'education.admin.student-lessons.content.show',
            compact(
                'studentLesson',
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
        EducationStudentLesson $studentLesson,
        EducationStudentLessonContent $content
    ) {
        $this->ensureContentBelongsToStudentLesson(
            $content,
            $studentLesson
        );

        $studentLesson->load([
            'student',
            'sourceLesson',
        ]);

        $content->load([
            'sourceContent',
        ]);

        return view(
            'education.admin.student-lessons.content.edit',
            compact(
                'studentLesson',
                'content'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        EducationStudentLesson $studentLesson,
        EducationStudentLessonContent $content
    ) {
        $this->ensureContentBelongsToStudentLesson(
            $content,
            $studentLesson
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDATE EXISTING CONTENT
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'type' => [
                'required',
                'string',
                'in:text,image,link,file',
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
                'string',
                'max:2048',
            ],

            'file' => [
                'nullable',
                'file',
                'max:20480',
            ],

            'image' => [
                'nullable',
                'image',
                'max:20480',
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


            /*
            |--------------------------------------------------------------------------
            | NEW ITEMS
            |--------------------------------------------------------------------------
            */

            'new_items' => [
                'nullable',
                'array',
            ],

            'new_items.*.type' => [
                'required',
                'string',
                'in:text,image,link,file',
            ],

            'new_items.*.title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'new_items.*.description' => [
                'nullable',
                'string',
            ],

            'new_items.*.content' => [
                'nullable',
                'string',
            ],

            'new_items.*.url' => [
                'nullable',
                'string',
                'max:2048',
            ],

            'new_items.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'new_items.*.file' => [
                'nullable',
                'file',
                'max:20480',
            ],
        ]);


        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | UPDATE CURRENT CONTENT
            |--------------------------------------------------------------------------
            */

            $data = [

                'type' =>
                    $validated['type'],

                'title' =>
                    $validated['title'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'content' =>
                    $validated['content'] ?? null,

                'url' =>
                    $validated['url'] ?? null,

                'sort_order' =>
                    $validated['sort_order']
                    ?? $content->sort_order,

                'is_active' =>
                    array_key_exists(
                        'is_active',
                        $validated
                    )
                        ? (bool) $validated['is_active']
                        : $content->is_active,
            ];


            /*
            |--------------------------------------------------------------------------
            | REPLACEMENT FILE / IMAGE
            |--------------------------------------------------------------------------
            |
            | نبحث أولًا عن image ثم file.
            | إذا وجدنا ملفًا جديدًا:
            |
            | 1. نخزنه.
            | 2. نتأكد أن التخزين نجح.
            | 3. نحذف القديم.
            | 4. نحدث بيانات السجل.
            |
            */

            $uploadedFile = null;

            if ($request->hasFile('image')) {

                $uploadedFile =
                    $request->file('image');

            } elseif ($request->hasFile('file')) {

                $uploadedFile =
                    $request->file('file');
            }


            if ($uploadedFile) {

                /*
                |--------------------------------------------------------------
                | Store new file first
                |--------------------------------------------------------------
                */

                $fileData =
                    $this->storeUploadedFile(
                        $uploadedFile
                    );


                /*
                |--------------------------------------------------------------
                | Delete old physical file
                |--------------------------------------------------------------
                */

                $this->deleteFileIfExists(
                    $content->file_path
                );


                /*
                |--------------------------------------------------------------
                | Update file information
                |--------------------------------------------------------------
                */

                $data = array_merge(
                    $data,
                    $fileData
                );
            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE CURRENT RECORD
            |--------------------------------------------------------------------------
            */

            $content->update($data);


            /*
            |--------------------------------------------------------------------------
            | ADD MULTIPLE NEW CONTENT ITEMS
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['new_items'])) {

                foreach (
                    $validated['new_items']
                    as $index => $item
                ) {

                    /*
                    |----------------------------------------------------------
                    | Skip completely empty items
                    |----------------------------------------------------------
                    */

                    $hasFile =
                        $request->hasFile(
                            "new_items.$index.file"
                        );

                    $hasText =
                        !empty($item['title']) ||
                        !empty($item['description']) ||
                        !empty($item['content']) ||
                        !empty($item['url']);


                    if (
                        !$hasFile &&
                        !$hasText
                    ) {
                        continue;
                    }


                    /*
                    |----------------------------------------------------------
                    | Prepare new content
                    |----------------------------------------------------------
                    */

                    $newData = [

                        'education_student_lesson_id' =>
                            $studentLesson->id,

                        'source_content_id' =>
                            null,

                        'type' =>
                            $item['type'],

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
                                && $item['sort_order'] !== ''
                                    ? (int) $item['sort_order']
                                    : $this->getNextSortOrder(
                                        $studentLesson
                                    ),

                        'is_active' =>
                            true,
                    ];


                    /*
                    |----------------------------------------------------------
                    | Store new file / image
                    |----------------------------------------------------------
                    */

                    if ($hasFile) {

                        $newFile =
                            $request->file(
                                "new_items.$index.file"
                            );

                        $fileData =
                            $this->storeUploadedFile(
                                $newFile
                            );

                        $newData =
                            array_merge(
                                $newData,
                                $fileData
                            );
                    }


                    /*
                    |----------------------------------------------------------
                    | Create new content record
                    |----------------------------------------------------------
                    */

                    EducationStudentLessonContent::create(
                        $newData
                    );
                }
            }


            DB::commit();


            return redirect()
                ->route(
                    'education.admin.student-lessons.content.index',
                    $studentLesson
                )
                ->with(
                    'success',
                    'Content updated and new content added successfully.'
                );

        } catch (Throwable $e) {

            DB::rollBack();

            Log::error(
                'Failed to update student lesson content.',
                [
                    'student_lesson_id' =>
                        $studentLesson->id,

                    'content_id' =>
                        $content->id,

                    'error' =>
                        $e->getMessage(),

                    'trace' =>
                        $e->getTraceAsString(),
                ]
            );

            return back()
                ->withInput()
                ->withErrors([
                    'content' =>
                        'Unable to update the content. Please try again.',
                ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    */

    public function toggleStatus(
        EducationStudentLesson $studentLesson,
        EducationStudentLessonContent $content
    ) {
        $this->ensureContentBelongsToStudentLesson(
            $content,
            $studentLesson
        );

        $content->update([
            'is_active' =>
                !$content->is_active,
        ]);

        return back()->with(
            'success',
            $content->is_active
                ? 'Content activated successfully.'
                : 'Content deactivated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        EducationStudentLesson $studentLesson,
        EducationStudentLessonContent $content
    ) {
        $this->ensureContentBelongsToStudentLesson(
            $content,
            $studentLesson
        );

        DB::beginTransaction();

        try {

            $this->deleteFileIfExists(
                $content->file_path
            );

            $content->delete();

            DB::commit();

            return redirect()
                ->route(
                    'education.admin.student-lessons.content.index',
                    $studentLesson
                )
                ->with(
                    'success',
                    'Student lesson content deleted successfully.'
                );

        } catch (Throwable $e) {

            DB::rollBack();

            Log::error(
                'Failed to delete student lesson content.',
                [
                    'student_lesson_id' =>
                        $studentLesson->id,

                    'content_id' =>
                        $content->id,

                    'error' =>
                        $e->getMessage(),
                ]
            );

            return back()->withErrors([
                'content' =>
                    'Unable to delete the content. Please try again.',
            ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | REORDER
    |--------------------------------------------------------------------------
    */

    public function reorder(
        Request $request,
        EducationStudentLesson $studentLesson
    ) {
        $validated = $request->validate([

            'items' => [
                'required',
                'array',
            ],

            'items.*.id' => [
                'required',
                'integer',
                'exists:education_student_lesson_contents,id',
            ],

            'items.*.sort_order' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);


        DB::transaction(function () use (
            $validated,
            $studentLesson
        ) {

            foreach (
                $validated['items']
                as $item
            ) {

                EducationStudentLessonContent::query()
                    ->where(
                        'id',
                        $item['id']
                    )
                    ->where(
                        'education_student_lesson_id',
                        $studentLesson->id
                    )
                    ->update([
                        'sort_order' =>
                            $item['sort_order'],
                    ]);
            }
        });


        return response()->json([
            'success' => true,
            'message' =>
                'Content order updated successfully.',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | STORE UPLOADED FILE
    |--------------------------------------------------------------------------
    */

    protected function storeUploadedFile($file): array
    {
        $directory =
            public_path(
                'images/education/student-lessons'
            );


        if (!File::exists($directory)) {

            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }


        $extension =
            strtolower(
                $file->getClientOriginalExtension()
            );


        $fileName =
            Str::uuid()
            . '.'
            . $extension;


        $file->move(
            $directory,
            $fileName
        );


        $relativePath =
            'images/education/student-lessons/'
            . $fileName;


        $fullPath =
            public_path($relativePath);


        /*
        |--------------------------------------------------------------------------
        | Make sure file really exists
        |--------------------------------------------------------------------------
        */

        if (
            !File::exists($fullPath) ||
            !File::isFile($fullPath)
        ) {

            throw new \RuntimeException(
                'Uploaded file could not be stored.'
            );
        }


        return [

            'file_path' =>
                $relativePath,

            'file_name' =>
                $file->getClientOriginalName(),

            'mime_type' =>
                $file->getClientMimeType(),

            'file_size' =>
                File::size($fullPath),
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | NEXT SORT ORDER
    |--------------------------------------------------------------------------
    */

    protected function getNextSortOrder(
        EducationStudentLesson $studentLesson
    ): int {

        $max =
            EducationStudentLessonContent::query()
                ->where(
                    'education_student_lesson_id',
                    $studentLesson->id
                )
                ->max('sort_order');


        return ((int) $max) + 1;
    }


    /*
    |--------------------------------------------------------------------------
    | ENSURE CONTENT BELONGS TO STUDENT LESSON
    |--------------------------------------------------------------------------
    */

    protected function ensureContentBelongsToStudentLesson(
        EducationStudentLessonContent $content,
        EducationStudentLesson $studentLesson
    ): void {

        abort_unless(
            (int) $content->education_student_lesson_id ===
            (int) $studentLesson->id,
            404
        );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE FILE
    |--------------------------------------------------------------------------
    */

    protected function deleteFileIfExists(
        ?string $filePath
    ): void {

        if (empty($filePath)) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Safety check
        |--------------------------------------------------------------------------
        */

        $prefix =
            'images/education/student-lessons/';


        if (
            !str_starts_with(
                $filePath,
                $prefix
            )
        ) {
            return;
        }


        $fullPath =
            public_path($filePath);


        if (
            File::exists($fullPath) &&
            File::isFile($fullPath)
        ) {

            File::delete($fullPath);
        }
    }
}
