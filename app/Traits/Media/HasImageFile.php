<?php

namespace App\Traits\Media;

use App\Enums\Media\MediaType;
use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasImageFile
{
    public function images(): MorphMany
    {
        return $this->morphMany(Media::class, 'model')->where('type', '=', MediaType::image->name);
    }
}
