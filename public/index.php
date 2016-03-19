<?php

require_once __DIR__ . '/../bootstrap.php';

// Set up dependencies
require __DIR__ . '/../config/dependencies.php';

// Register middleware
require __DIR__ . '/../config/middleware.php';

// Register routes
foreach (glob(__DIR__ . '/../routes/*.php') as $routeFile) {
    require_once $routeFile;
}

// Run app
$app->run();
