<?php

namespace App\Services\Api\Media\Strategies;

use App\Models\Media;

class FileStrategy extends CoreStrategy
{
    public function get(): array
    {
        dump($this);

        return [];
    }

    public function create(mixed $payload): Media
    {
    }

    public function update(mixed $payload): Media
    {
    }

    public function delete(): bool
    {
    }
}
