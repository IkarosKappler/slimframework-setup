<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view (default)
    // return $this->renderer->render($response, 'index.phtml', $args);

    // Render index (with twig)
    return $this->renderer->render($response, 'index.phtml', [
        'name' => array_key_exists('name',$args) ? $args['name'] : null
    ]);
})->setName('profile');
