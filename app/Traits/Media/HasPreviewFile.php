<?php

namespace App\Traits\Media;

use App\Enums\Media\MediaType;
use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasPreviewFile
{
    public function preview(): MorphOne
    {
        return $this->MorphOne(Media::class, 'model')->where('type', '=', MediaType::preview->name);
    }
}
