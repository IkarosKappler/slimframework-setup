<?php

//use \Slim\Log;
//use \Monolog\Logger;

//$logWriter = new \Slim\LogWriter(fopen('storage/error.log', 'a'));

return [
    'settings' => [
            'debug' => true,
                //'log.writer' => $logWriter,
            'log.enabled' =>    true,
                'log.level' =>      'debug', // \Slim\Log::DEBUG,
            'mode' =>           'development', 
            'displayErrorDetails' => true, // set to false in production
            'addContentLengthHeader' => false, // Allow the web server to send the content-length header
            
        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
                //'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
