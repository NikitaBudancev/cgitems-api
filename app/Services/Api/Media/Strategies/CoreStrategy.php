<?php

namespace App\Services\Api\Media\Strategies;

use App\DTO\Media\MediaDto;
use App\Models\Media;

abstract class CoreStrategy
{
    private MediaDto $media;

    private array $config;

    public function getMedia(): MediaDto
    {
        return $this->media;
    }

    public function setMedia(MediaDto $media): static
    {
        $this->media = $media;

        return $this;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config): static
    {
        $this->config = $config;

        return $this;
    }

    abstract public function get(): array;

    abstract public function create(mixed $payload): Media;

    abstract public function update(mixed $payload): Media;

    abstract public function delete(): bool;
}
