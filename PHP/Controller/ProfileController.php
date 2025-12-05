<?php
    require_once __DIR__ . '/../BDD/bdd_functions.php';

    class ProfileController {
        function show($user_id) {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit;
            }
            $userProfile = getUserById($user_id);
            include __DIR__ . '/../Views/viewProfile.php';
        }

        function update() {
            header('Content-Type: application/json');
            
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                echo json_encode(['success' => false, 'error' => 'Non authentifié']);
                exit;
            }

            $data = json_decode(file_get_contents('php://input'), true);
            $userId = $data['user_id'] ?? null;
            $name = trim($data['name'] ?? '');
            $email = trim($data['email'] ?? '');
            $password = $data['password'] ?? null;

            // Validate user_id
            if (!$userId) {
                echo json_encode(['success' => false, 'error' => 'ID utilisateur manquant']);
                exit;
            }

            // Validate inputs
            if (empty($name) || empty($email)) {
                echo json_encode(['success' => false, 'error' => 'Le nom et l\'email sont requis']);
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'error' => 'Email invalide']);
                exit;
            }

            try {
                // Update user profile
                $updated = updateUserProfile($userId, $name, $email, $password);
                
                if ($updated) {
                    // Update session only if the user is editing their own profile
                    if ($userId == $_SESSION['user_id']) {
                        $_SESSION['user_name'] = $name;
                        $_SESSION['user_email'] = $email;
                    }
                    
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Erreur lors de la mise à jour']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => $e->getMessage()]);
            }
        }
    }
?>
