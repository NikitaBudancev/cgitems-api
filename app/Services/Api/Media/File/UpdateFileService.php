<?php

namespace App\Services\Api\Media\File;

use App\Exceptions\SaveFileException;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateFileService
{
    /**
     * @throws SaveFileException
     */
    public function __invoke(string $filename, array $config, UploadedFile $file): string
    {
        try {
            $disk = config('media.disk.image');
            $folder = $config['folder'];

            $isSave = Storage::disk($disk)->put("{$folder}/{$filename}", $file->get());

            if (! $isSave) {
                throw new SaveFileException('Ошибка при сохранении файла.');
            }

            return $filename;
        } catch (FileNotFoundException $e) {
            throw new SaveFileException('Файл не найден: '.$e->getMessage());
        } catch (Exception $e) {
            logger()->error($e);
            throw new SaveFileException('Внутренняя ошибка сервиса: '.$e->getMessage());
        }
    }
}
