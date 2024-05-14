<?php

namespace App\DTO\Projects;

use App\DTO\CoreDto;

class UpdateProjectDto extends CoreDto
{
    public int $id;

    public string $name;

    public string $projectDescription;

    public int $courseId;

    public int $projectTypeId;

    public int $currentStageId;

    public int $stageId;

    public $preview;

    public array $media;
}
