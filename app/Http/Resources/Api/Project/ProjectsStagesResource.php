<?php

namespace App\Http\Resources\Api\Project;

use App\Facades\Api\ApiMediaManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectsStagesResource extends JsonResource
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
            'property' => new ProjectStageResource($this->property),
            'preview' => ApiMediaManager::transform($this->preview),
        ];
    }
}
