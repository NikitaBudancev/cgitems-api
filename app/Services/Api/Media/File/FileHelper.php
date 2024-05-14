<?php

namespace App\Services\Api\Media\File;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function randomFileName(string $extension): string
    {
        return uniqid() . mt_rand(100, 999) . '.' . $extension;
    }

    public static function getFullPublicPath(string $disk, string $folder, string $name): string
    {
        return Storage::disk($disk)->url("{$folder}/") . $name;
    }

    public static function getFullPath(string $disk, string $folder, string $name): string
    {
        return public_path("{$disk}/{$folder}/{$name}");
    }

    public static function getFileNameWithoutExtension($path): string
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function getFileExtension($path): string
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }
}
