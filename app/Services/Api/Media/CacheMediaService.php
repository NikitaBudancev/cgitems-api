<?php

namespace App\Services\Api\Media;

use Illuminate\Support\Facades\Redis;

class CacheMediaService
{
    
    /**
     * @param int $id
     * @return array
     */
    public function getCache(int $id): array
    {
        $cacheKey = $this->getCacheKey($id);
        $cache = Redis::get($cacheKey);

        if (!$cache) {
            return [];
        }

        return json_decode($cache, true);
    }

    /**
     * @param int $id
     * @param array $array
     * @return void
     */
    public function setCache(int $id, array $array): void
    {
        $cacheKey = $this->getCacheKey($id);
        Redis::set($cacheKey, json_encode($array));
    }

    private function getCacheKey(int $id): string
    {
        return config('media.cache_prefix') . $id;
    }

}
