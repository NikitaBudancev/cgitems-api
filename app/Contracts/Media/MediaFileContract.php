<?php

namespace App\Contracts\Media;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface MediaFileContract
{
    public function media(): MorphMany;
}
