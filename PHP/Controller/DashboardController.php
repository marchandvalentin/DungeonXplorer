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

        function searchItems(){
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

            $items = searchItemsByName($searchTerm);
            
            header('Content-Type: application/json');
            echo json_encode($items);
        }

        function searchChapters(){
            if (!isset($_SESSION['user_id']) || $_SESSION['IS_ADMIN'] < 1) {
                http_response_code(403);
                echo json_encode(['error' => 'Unauthorized']);
                exit;
            }

            $searchTerm = $_GET['id'] ?? '';
            
            if (empty($searchTerm)) {
                echo json_encode([]);
                exit;
            }

            $chapters = searchChaptersById($searchTerm);
            
            header('Content-Type: application/json');
            echo json_encode($chapters);
        }

        function entityCreate() {
            if (!isset($_SESSION['user_id']) || $_SESSION['IS_ADMIN'] < 1) {
                http_response_code(403);
                echo json_encode(['error' => 'Unauthorized']);
                exit;
            }

            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!$data) {
                echo json_encode(['success' => false, 'error' => 'Données invalides']);
                exit;
            }

            $nom = $data['nom'] ?? null;
            $pv = $data['pv'] ?? null;
            $mana = $data['mana'] ?? null;
            $initiative = $data['initiative'] ?? null;
            $strength = $data['strength'] ?? null;
            $attack = $data['attack'] ?? null;
            $xp = $data['xp'] ?? null;
            $initiative = $data['initiative'] ?? null;
            $boss = !empty($data['boss']) ? 1 : 0;

            if ($titre === null || $content === null) {
                echo json_encode(['success' => false, 'error' => 'Tous les champs sont requis']);
                exit;
            }

            try {
                $entity_id = createEntity($nom, $pv, $mana,$initiative,$strength,$attack,$xp, $boss);
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => 'Exception: ' . $e->getMessage()]);
            }
        }
    }

?>