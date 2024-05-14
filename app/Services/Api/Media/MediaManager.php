<?php

namespace App\Services\Api\Media;

use App\DTO\Media\MediaDto;
use App\Models\Media;
use App\Services\Api\Media\Strategies\CoreStrategy;
use Exception;
use Illuminate\Database\Eloquent\Collection;

final readonly class MediaManager
{
    public function __construct(
        private CacheMediaService $cacheService
    ) {
    }

    /**
     * @throws Exception
     */
    public function setMedia(MediaDto $media): CoreStrategy
    {
        return $this->initStrategy($media);
    }

    /**
     * @param  Media  $media
     *
     * @throws Exception
     */
    public function transform($media): array
    {
        if (! $media) {
            return [];
        }

        $cache = $this->cacheService->getCache($media->id);

        if ($cache) {
            return $cache;
        }

        $mediaDto = MediaDto::fromModel($media);
        $result = $this->initStrategy($mediaDto)->get();
        $this->cacheService->setCache($mediaDto->id, $result);

        return $result;
    }

    /**
     * @throws Exception
     */
    public function transformCollection(Collection $collection): array
    {
        return $collection->map(function (Media $media) {
            return $this->transform($media);
        })->all();
    }

    public function getConfig(string $mediaType, string $modelType): array
    {
        return config($this->renderConfigName($mediaType, $modelType)) ?: [];
    }

    /**
     * @throws Exception
     */
    private function initStrategy(MediaDto $media): mixed
    {
        $mediaType = $media->type;
        $strategies = config('media.strategies');

        foreach ($strategies as $key => $types) {
            if (in_array($mediaType, $types)) {
                return $this->resolveStrategyClassName($key, $media);
            }
        }

        $defaultStrategyKey = $mediaType . class_basename($media->modelType);

        return $this->resolveStrategyClassName($defaultStrategyKey, $media);
    }

    /**
     * @throws Exception
     */
    private function resolveStrategyClassName(string $strategyKey, MediaDto $media): mixed
    {
        $strategyClassName = ucfirst($strategyKey) . 'Strategy';
        $strategyClass = __NAMESPACE__ . '\\Strategies\\' . $strategyClassName;

        if (class_exists($strategyClass)) {
            $config = $this->getConfig($media->type, $media->modelType);

            return app($strategyClass)
                ->setMedia($media)
                ->setConfig($config);
        }

        throw new Exception("Класс стратегии не найден: $strategyClass");
    }

    private function renderConfigName(string $mediaType, string $modelType): string
    {
        $modelType = class_basename($modelType);
        $modelType = preg_replace('/(?<!^)([A-Z])/', '_$1', $modelType);
        $modelType = strtolower($modelType);

        return "media.{$modelType}.{$mediaType}";
    }
}
