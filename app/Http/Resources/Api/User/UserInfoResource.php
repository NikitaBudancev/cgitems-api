<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'vk' => $this->vk,
            'behance' => $this->behance,
            'facebook' => $this->facebook,
            'artstation' => $this->artstation,
        ];
    }
}
