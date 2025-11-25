<?php
session_start();

require 'vendor/autoload.php';
require 'PHP/Controller/LoginController.php';
require 'PHP/Controller/RegisterController.php';

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

$router->post('/login', function() {
    $controller = new LoginController();
    $controller->login();
});

$router->get('/register', function() {
    $controller = new RegisterController();
    $controller->show();
});

$router->post('/register', function() {
    $controller = new RegisterController();
    $controller->register();
});

// Run the router
$router->run();
 
?>