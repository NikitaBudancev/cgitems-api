<?php

namespace App\Facades\Api;

use App\DTO\Media\MediaDto;
use App\Models\Media;
use App\Services\Api\Media\Strategies\CoreStrategy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;


/**
 * Class MediaManager
 *
 * @method static CoreStrategy setMedia(MediaDto $media)
 * @method static array transform(Media $media)
 * @method static array transformCollection(Collection $media)
 * @method static array getConfig(string $mediaType, string $modelType)
 */
class ApiMediaManager extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ApiMediaManager';
    }
}
