<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 9/03/16
 * Time: 0:47
 */

use Aoa\Core\Dotenv\EnvironmentVariables;

return [
    'database' => [
        'driver' => 'pdo_mysql',
        'host' => getenv(EnvironmentVariables::DB_HOST),
        'user' => getenv(EnvironmentVariables::DB_USER),
        'password' => getenv(EnvironmentVariables::DB_PASSWORD),
        'dbname' => getenv(EnvironmentVariables::DB_NAME),
        'entitiesPaths' => [
            __DIR__ . '/../src/Entity'
        ],
        'charset'  => 'utf8'
    ]
];
