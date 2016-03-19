<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    return $response;
});
