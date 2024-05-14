<?php

namespace App\Services\Api\Utils;

use Illuminate\Support\Str;

class SlugService
{
    public function generateUniqueSlug(string $name, string $model): string
    {
        $slug = $baseSlug = Str::slug($name);
        $counter = 1;

        while ($model::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
