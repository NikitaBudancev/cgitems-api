<?php

namespace App\Http\Resources\Api\Project;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'projectDescription' => $this->project_description,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'createdAt' => $this->created_at,
            'currentStageId' => $this->current_stage_id,
            'user' => new ProjectUserResource($this->user),
            'projectType' => new ProjectTypeResource($this->project_type),
            'stages' => ProjectStagesResource::collection($this->stages),
            'course' => new ProjectCourseResource($this->course),
        ];
    }
}
