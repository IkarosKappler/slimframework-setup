<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
// EDIT IKA 2017-12-04
//   DISABLED THE DEFAULT RENDERER (replaced by twig)
/*
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};
*/

// ADDED BY IKA
// Register component on container
$container['renderer'] = function ($container) {
    $view = new \Slim\Views\Twig('../templates', [
        'cache' => '../cache'
    ]);
    
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
};



// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
