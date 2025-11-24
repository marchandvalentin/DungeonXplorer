<?php

require 'vendor/autoload.php';

use Bramus\Router\Router;

// Initialize the router
$router = new Router();

// Define a simple route
$router->get('/', function() {
    echo 'Hello, World2!';
});

$router->get('/about', function() {
    echo 'This is the about page.';
});

// Run the router
$router->run();

?>