<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 9/03/16
 * Time: 1:17
 */
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

// replace with file to your own project bootstrap
require_once 'bootstrap.php';

// database configuration parameters
$databaseSettings = require_once __DIR__ . '/config/database.php';
$databaseSettings = $databaseSettings['database'];

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration($databaseSettings['entitiesPaths'], $isDevMode);

// obtaining the entity manager
$entityManager = EntityManager::create($databaseSettings, $config);

return ConsoleRunner::createHelperSet($entityManager);
