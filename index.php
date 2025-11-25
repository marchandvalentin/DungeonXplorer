<?php

require 'vendor/autoload.php';
require 'PHP/Controller/LoginController.php';

use Bramus\Router\Router;

// Initialize the router
$router = new Router();

// Define a simple route
$router->get('/', function() {
    include 'PHP/Views/viewWelcome.php';
});

$router->get('/login', function() {
    $controller = new LoginController();
    $controller->show();
});

$router->get('/register', function() {
    $controller = new RegisterController();
    $controller->show();
});

// Run the router
$router->run();

?>