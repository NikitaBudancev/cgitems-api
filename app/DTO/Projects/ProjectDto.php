<?php

namespace App\DTO\Projects;

use App\DTO\CoreDto;

class ProjectDto extends CoreDto
{
    public int $id;

    public string $name;

    public string $slug;

    public int $userId;

    public string $title;

    public string $keywords;

    public string $description;

    public bool $published;

    public string $review;

    public int $courseId;

    public string $projectDescription;

    public int $currentStageId;

    public string $createdAt;

    public string $updatedAt;
}
