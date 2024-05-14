<?php

namespace App\Traits\Media;

use App\Enums\Media\MediaType;
use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasAvatarFile
{
    public function avatar(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')->where('type', '=', MediaType::avatar->name);
    }
}
