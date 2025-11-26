<?php
session_start();

require 'vendor/autoload.php';
require 'PHP/Controller/LoginController.php';
require 'PHP/Controller/RegisterController.php';
require 'PHP/Controller/DashboardController.php';
require 'PHP/Controller/CreateHeroController.php';

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

$router->get('/logout', function() {
    $controller = new LoginController();
    $controller->logout();
});

$router->get('/dashboard', function() {
    $controller = new DashboardController();

    if (isset($_SESSION['user_id'])) {
        $controller->show();
    } 
});

$router->get('/createHero', function() {
    $controller = new CreateHeroController();
    $controller->show();
});

$router->post('/createHero', function() {
    $controller = new CreateHeroController();

    if (isset($_SESSION['user_id'])) {
        $controller->create();
    } 
});

// Run the router
$router->run();
 
?>