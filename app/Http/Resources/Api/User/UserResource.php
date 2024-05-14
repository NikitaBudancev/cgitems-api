<?php

namespace App\Http\Resources\Api\User;

use App\Facades\Api\ApiMediaManager;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     *
     * @throws Exception
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'nickname' => $this->nickname,
            'role' => $this->role[0]->name,
            'initials' => $this->initials,
            'verified' => $this->is_verified,
            'info' => new UserInfoResource($this->info),
            'avatar' => ApiMediaManager::transform($this->avatar),
        ];
    }
}
