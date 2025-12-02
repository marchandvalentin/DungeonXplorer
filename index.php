<?php
session_start();
require_once __DIR__ . '/PHP/BDD/bdd_functions.php';
require 'vendor/autoload.php';
require 'PHP/Controller/LoginController.php';
require 'PHP/Controller/RegisterController.php';
require 'PHP/Controller/DashboardController.php';
require 'PHP/Controller/CreateHeroController.php';
require 'PHP/Controller/HeroSelectionController.php';
require 'PHP/Controller/ChapterController.php';
require 'PHP/Controller/ProfileController.php';

use Bramus\Router\Router;

// Initialize the router
$router = new Router();

// Serve static files (CSS, JS, images)
$router->match('GET', '/JS/(.*)', function() {
    return false; // Let the web server handle it
});

$router->match('GET', '/CSS/(.*)', function() {
    return false; // Let the web server handle it
});

$router->match('GET', '/res/(.*)', function() {
    return false; // Let the web server handle it
});

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

$router->get('/profile/{user_id}', function($user_id) {
    $controller = new ProfileController();
    $controller->show($user_id);
});

$router->post('/profile/update', function() {
    $controller = new ProfileController();
    $controller->update();
});

$router->get('/dashboard', function() {
    $controller = new DashboardController();

    if (isset($_SESSION['user_id']) && ($_SESSION['IS_ADMIN'] >= 1)) {
        $controller->show();
    } 
});

$router->get('/dashboard/search-users', function() {
    $controller = new DashboardController();
    $controller->searchUsers();
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

$router->get('/fight/{hero_id}/{chapter_id}', function($hero_id, $chapter_id) {
    if (isset($_SESSION['user_id'])) {
        $controller = new ChapterController();
        $controller->fight($hero_id, $chapter_id);
    } else {
        header('Location: /login');
        exit();
    }
});

$router->get('/save/{hero_id}/{chapter_id}', function($hero_id, $chapter_id) {
    if (isset($_SESSION['user_id'])) {
        saveHeroProgress($hero_id, $chapter_id, 'finished');
        header('Location: /heros');
        exit();
    } else {
        header('Location: /login');
        exit();
    }
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

$router->post('/fight/result', function() {
    if (isset($_SESSION['user_id'])) {
        $controller = new ChapterController();
        $controller->fightResult();
    } else {
        http_response_code(401);
        exit();
    }
});

// Run the router
$router->run();

?>