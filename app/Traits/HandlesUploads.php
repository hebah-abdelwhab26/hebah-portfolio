<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesUploads
{
    /**
     * Upload file to storage/app/public
     */
    protected function uploadFile(
        UploadedFile $file,
        string $folder
    ): string {

        $filename =
            Str::uuid()
            . '.'
            . $file->getClientOriginalExtension();

        return $file->storeAs(
            $folder,
            $filename,
            'public'
        );
    }

    /**
     * Replace old file
     */
    protected function replaceFile(
        ?string $oldFile,
        UploadedFile $newFile,
        string $folder
    ): string {

        if (
            $oldFile &&
            Storage::disk('public')->exists($oldFile)
        ) {

            Storage::disk('public')->delete($oldFile);

        }

        return $this->uploadFile(
            $newFile,
            $folder
        );
    }

    /**
     * Delete file
     */
    protected function deleteFile(
        ?string $path
    ): void {

        if (
            $path &&
            Storage::disk('public')->exists($path)
        ) {

            Storage::disk('public')->delete($path);

        }

    }

    /**
     * Upload multiple files
     */
    protected function uploadMultiple(
        array $files,
        string $folder
    ): array {

        $paths = [];

        foreach ($files as $file) {

            $paths[] = $this->uploadFile(
                $file,
                $folder
            );

        }

        return $paths;
    }
}
