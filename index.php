<?php
session_start();

require 'vendor/autoload.php';
require 'PHP/Controller/LoginController.php';
require 'PHP/Controller/RegisterController.php';
require 'PHP/Controller/DashboardController.php';
require 'PHP/Controller/CreateHeroController.php';
require 'PHP/Controller/HeroSelectionController.php';
require 'PHP/Controller/ChapterController.php';

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

    if (isset($_SESSION['user_id']) && ($_SESSION['IS_ADMIN'] >= 1)) {
        $controller->show();
    } 
});

$router->get('/heros', function() {
    if (isset($_SESSION['user_id'])) {
        $controller = new HeroSelectionController();
        $heros = $controller->getHerosByUserId($_SESSION['user_id']);
        $controller->show();
    } else {
        header('Location: /login');
        exit();
    }
});

$router->get('/createHero', function() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }
    
    $controller = new CreateHeroController();
    $controller->show();
});

$router->post('/create-hero', function() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }
    
    $controller = new CreateHeroController();
    $controller->create();
});

$router->get('/chapter/{hero}/{chapter_id}', function($hero, $chapter_id) {
    if (isset($_SESSION['user_id'])) {
        $controller = new ChapterController();
        $controller->show($hero, $chapter_id);
    } else {
        header('Location: /login');
        exit();
    }
});

// Run the router
$router->run();
 
?>