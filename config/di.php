<?php
/**
 * Di-конфиг приложения.
 */

use Evas\Di;
use core\RedisDialog as Redis;

return [
    'cache' => Di\createOnce(Redis::class, [
        Di\includeFileOnce('config/redis.php')
    ]),
];
