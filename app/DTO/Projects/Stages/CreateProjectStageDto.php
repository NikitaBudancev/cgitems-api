<?php

namespace App\DTO\Projects\Stages;

use App\DTO\CoreDto;
use Illuminate\Http\UploadedFile;

class CreateProjectStageDto extends CoreDto
{
    public int $projectId;

    public int $stageId;

    public UploadedFile $preview;

    public array $media;
}
