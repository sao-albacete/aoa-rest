<?php
/**
 * Created by aoa-rest.
 * User: viktorKhan
 * Date: 18/03/16
 * Time: 12:19
 */
use Dotenv\Dotenv;
use RKA\ZsmSlimContainer\Container;
use Zend\Stdlib\ArrayUtils;

// Require autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables file
//$dotenv = new Dotenv(__DIR__ . '/..');
//$dotenv->load();
//
//// Get settings
//$databaseSettings = require_once __DIR__ . '/../config/database.php';
//$loggerSettings = require_once __DIR__ . '/../config/logger.php';
//$settings = require_once __DIR__ . '/../config/settings.php';
//$settings['settings'] = array_merge($settings['settings'], $databaseSettings, $loggerSettings);
//
//// Get services
//$services = require_once __DIR__ . '/../config/services.php';
//
//// Genenerate DI container with config
//$config = array_merge($services, $settings);
//$container = new Container($config);
