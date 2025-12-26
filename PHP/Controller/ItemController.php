<?php
    require_once __DIR__ . '/../BDD/bdd_functions.php';

    class ItemController {
        
        function show($item_id) {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit();
            }

            $item = getItemById($item_id);
            $itemProperties = getItemPropertyById($item_id);
            
            if (!$item) {
                header('Location: /dashboard');
                exit();
            }

            include __DIR__ . '/../Views/viewItemDetails.php';
        }

        function update($item_id) {
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

            $name = $data['name'] ?? null;
            $description = $data['description'] ?? null;
            $type = $data['type'] ?? null;

            if ($name === null || $description === null || $type === null) {
                echo json_encode(['success' => false, 'error' => 'Tous les champs sont requis']);
                exit;
            }

            try {
                $result = updateItem($item_id, $name, $description, $type);

                if ($result) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Erreur lors de la mise à jour - Résultat false']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => 'Exception: ' . $e->getMessage()]);
            }
        }
    }
?>
