<?php

namespace App\Http\Resources\Api\Project\Profile;

use App\Http\Resources\Api\Project\ProjectCourseResource;
use App\Http\Resources\Api\Project\ProjectsStagesResource;
use App\Http\Resources\Api\Project\ProjectTypeResource;
use App\Http\Resources\Api\Project\ProjectUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'createdAt' => $this->created_at,
            'projectType' => new ProjectTypeResource($this->projectType),
            'stage' => new ProjectsStagesResource($this->stage),
            'course' => new ProjectCourseResource($this->course),
        ];
    }

}
