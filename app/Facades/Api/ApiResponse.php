<?php

namespace App\Facades\Api;

use Illuminate\Support\Facades\Facade;


/**
 * Class ApiResponseService
 *
 * @method static \App\Services\Api\ApiResponseService success(null $data = null)
 * @method static \App\Services\Api\ApiResponseService error(string $messageCode = null, array $errors = [])
 * @method \App\Services\Api\ApiResponseService respond(int $code = null, array $headers = [])
 */
class ApiResponse extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ApiResponse';
    }
}
