<?php
/**
 * Конфиг базы данных.
 */
return [
    // 'options' => [], // опции соединения с субд
    'driver' => env('DB_DRIVER', 'mysql'), // драйвер субд (по умолчанию mysql)
    'charset' => env('DB_CHARSET', 'utf8'), // кодировка данных (по умолчанию utf8)

    'host' => env('DB_HOST', 'localhost'), // хост субд (по умолчанию localhost)
    'username' => env('DB_USERNAME', 'root'), // пользователь субд
    'password' => env('DB_PASSWORD'), // пароль субд
    'dbname' => env('DB_DBNAME'), // имя базы данных
];
