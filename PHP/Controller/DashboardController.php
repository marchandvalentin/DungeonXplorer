<?php
    require_once __DIR__ . '/../BDD/bdd_functions.php';

    class DashboardController{
        function show(){
            include __DIR__ . '/../Views/viewDashboard.php';
        }

        function searchUsers(){
            if (!isset($_SESSION['user_id']) || $_SESSION['IS_ADMIN'] < 1) {
                http_response_code(403);
                echo json_encode(['error' => 'Unauthorized']);
                exit;
            }

            $searchTerm = $_GET['name'] ?? '';
            
            if (empty($searchTerm)) {
                echo json_encode([]);
                exit;
            }

            $users = searchUsersByName($searchTerm);
            
            header('Content-Type: application/json');
            echo json_encode($users);
        }

        function searchHeroes(){
            if (!isset($_SESSION['user_id']) || $_SESSION['IS_ADMIN'] < 1) {
                http_response_code(403);
                echo json_encode(['error' => 'Unauthorized']);
                exit;
            }

            $searchTerm = $_GET['name'] ?? '';
            
            if (empty($searchTerm)) {
                echo json_encode([]);
                exit;
            }

            $heroes = searchHeroesByName($searchTerm);
            
            header('Content-Type: application/json');
            echo json_encode($heroes);
        }
    }

?>