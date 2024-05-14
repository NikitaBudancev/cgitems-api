<?php

namespace App\Traits\Media;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMediaFile
{
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

}
