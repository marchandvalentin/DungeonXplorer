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

use Bramus\Router\Router;

// Handle static files BEFORE router initialization
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Debug logging
error_log("Request URI: " . $request_uri);

if (preg_match('#^/(JS|CSS|res)/(.+)$#i', $request_uri, $matches)) {
    $file_path = __DIR__ . $request_uri;
    error_log("Trying to serve: " . $file_path);
    error_log("File exists: " . (file_exists($file_path) ? 'yes' : 'no'));
    
    if (file_exists($file_path)) {
        // Set correct content type based on extension
        $extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
        $mime_types = [
            'js' => 'application/javascript',
            'css' => 'text/css',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'svg' => 'image/svg+xml',
        ];
        
        if (isset($mime_types[$extension])) {
            header('Content-Type: ' . $mime_types[$extension]);
        }
        readfile($file_path);
        exit;
    } else {
        error_log("File not found: " . $file_path);
    }
}

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

$router->get('/fight/{hero_id}/{chapter_id}', function($hero_id, $chapter_id) {
    if (isset($_SESSION['user_id'])) {
        $controller = new ChapterController();
        $controller->fight($hero_id, $chapter_id);
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