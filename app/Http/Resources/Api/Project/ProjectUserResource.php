<?php

namespace App\Http\Resources\Api\Project;

use App\Facades\Api\ApiMediaManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectUserResource extends JsonResource
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
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'nickname' => $this->nickname,
            'initials' => $this->initials,
            'avatar' => ApiMediaManager::transform($this->avatar)
        ];
    }
}
