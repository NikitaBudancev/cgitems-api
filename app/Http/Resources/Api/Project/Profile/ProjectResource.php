<?php

namespace App\Http\Resources\Api\Project\Profile;

use App\Http\Resources\Api\Project\ProjectCourseResource;
use App\Http\Resources\Api\Project\ProjectStagesResource;
use App\Http\Resources\Api\Project\ProjectTypeResource;
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
            'createdAt' => $this->created_at,
            'currentStageId' => $this->current_stage_id,
            'projectType' => new ProjectTypeResource($this->projectType),
            'stages' => ProjectStagesResource::collection($this->stages),
            'course' => new ProjectCourseResource($this->course),
            'review' => $this->review,
            'reviewDate' => $this->review_date,
        ];
    }
}
