<?php

namespace App\DTO\Projects;

use App\DTO\CoreDto;
use Illuminate\Http\UploadedFile;

class CreateProjectDto extends CoreDto
{
    public string $name;

    public string $projectDescription;

    public int $projectTypeId;

    public int $stageId;

    public UploadedFile $preview;

    public array $media;
}
