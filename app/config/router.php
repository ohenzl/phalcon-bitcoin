<?php

$router = $di->getRouter();

// Define your routes here
$router->add(
    '/',
    [
        'controller' => 'basic',
        'action'     => 'index',
    ]
);

$router->handle($_SERVER['REQUEST_URI']);
