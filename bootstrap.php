<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 9/03/16
 * Time: 1:19
 */
use Aoa\Core\Dotenv\EnvironmentVariables;
use Dotenv\Dotenv;
use RKA\ZsmSlimContainer\Container;
use Slim\App;
use Zend\Stdlib\ArrayUtils;

require __DIR__ . '/vendor/autoload.php';

session_start();

// Load environment variables file
$dotenv = new Dotenv(__DIR__);
$dotenv->load();
$dotenv->required(EnvironmentVariables::getRequired());

// Get settings
$databaseSettings = require_once __DIR__ . '/config/database.php';
$loggerSettings = require_once __DIR__ . '/config/logger.php';
$settings = require_once __DIR__ . '/config/settings.php';
$settings['settings'] = array_merge($settings['settings'], $databaseSettings, $loggerSettings);

// Get services
$services = require_once __DIR__ . '/config/services.php';

// Genenerate DI container with config
$config = array_merge($services, $settings);
$container = new Container($config);

// Instantiate the app
/** @var App $app */
$app = new Slim\App($container);
