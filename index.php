<?php
session_start();

require 'vendor/autoload.php';
require 'PHP/Controller/LoginController.php';
require 'PHP/Controller/RegisterController.php';
require 'PHP/Controller/HeroSelectionController.php';

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
    if (isset($_SESSION['user_id'])) {
        include 'PHP/Views/viewDashboard.php';
    } else {
        header('Location: /login');
        exit();
    }
});

$router->get('/heros', function() {
    if (isset($_SESSION['user_id'])) {
        $controller = new HeroSelectionController();
        $heros = $controller->getHerosByUserId($_SESSION['user_id']);
        $controller->show($_SESSION['user_id']);
    } else {
        header('Location: /login');
        exit();
    }
});

// Run the router
$router->run();
 
?>