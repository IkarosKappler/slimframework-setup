<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


// Configuration
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "slim_i2b";
$config['db']['pass']   = "int2byte";
$config['db']['dbname'] = "slim_i2b";



// Create app
$app = new \Slim\App( [ 'settings' => $config ] );
// Clear cached documents after 1 second (for development)
//$app->expires('+1 seconds');

// Get container
$container = $app->getContainer();

// Register component on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(
        '../resources/templates', [
        'cache' => '../storage/cache'
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};

// Render Twig template in route
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'welcome.blade.html', [
                'name' => $args['name']
    ]);
})->setName('profile');

// Run app
$app->run();
