<?php

namespace App\Repositories\Helpers;

use Closure;
use Illuminate\Support\Facades\Cache;

/**
 * Trait Cacheable
 * @package App\Repositories\Helpers
 */
trait Cacheable
{
    /**
     * Retrieve an item from the cache, but also store a default value if the requested item doesn't exist
     * For example, you may wish to retrieve all users from the cache or,
     * if they don't exist, retrieve them from the
     * database and add them to the cache
     *
     * More information can be found here https://laravel.com/docs/7.x/cache
     *
     * @param string $name     The key that we be used to identify the cache
     * @param Closure $closure The query that you want to cache
     * @param int $duration    The duration in minutes of the cached query.
     *
     * @return mixed
     */
    public function cacheQuery($name, Closure $closure, $duration = 1440)
    {
        return Cache::remember($name, $duration, $closure);
    }

    /**
     * Retrieve an item from the cache, but also store a default value if the requested item doesn't exist
     * For example, you may wish to retrieve all users from the cache or,
     * if they don't exist, retrieve them from the
     * database and add them to the cache
     *
     * More information can be found here https://laravel.com/docs/7.x/cache
     *
     * @param string $key
     * @return bool
     */
    public function removeQuery($key): bool
    {
        return Cache::forget($key);
    }
}
