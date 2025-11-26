<?php
    require_once __DIR__ . '/../BDD/bdd_functions.php';

    class CreateHeroController{
        private $errors = [];
        private $success = false;
        private $successMessage = '';

        function show(){
            // Get all available classes
            $classes = getAllClasses();
            $errors = $this->errors;
            $success = $this->success;
            $successMessage = $this->successMessage;
            include __DIR__ . '/../Views/viewCreateHero.php';
        }

        function create(){
            // Validate form submission
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                $this->show();
                return;
            }

            // Check if user is logged in
            if (!isset($_SESSION['user_id'])) {
                $this->errors[] = 'Vous devez être connecté pour créer un héros.';
                $this->show();
                return;
            }

            // Get form data
            $hero_name = trim($_POST['hero_name'] ?? '');
            $class_id = trim($_POST['class_id'] ?? '');

            // Validate inputs
            if (empty($hero_name)) {
                $this->errors[] = 'Le nom du héros est requis.';
            } elseif (strlen($hero_name) < 2) {
                $this->errors[] = 'Le nom du héros doit contenir au moins 2 caractères.';
            } elseif (strlen($hero_name) > 50) {
                $this->errors[] = 'Le nom du héros doit contenir au maximum 50 caractères.';
            }

            if (empty($class_id)) {
                $this->errors[] = 'Veuillez sélectionner une classe.';
            } elseif (!is_numeric($class_id)) {
                $this->errors[] = 'La classe sélectionnée est invalide.';
            }

            // If validation fails, show form with errors
            if (!empty($this->errors)) {
                $errors = $this->errors;
                $success = false;
                $classes = getAllClasses();
                include __DIR__ . '/../Views/viewCreateHero.php';
                return;
            }

            // Create the hero
            try {
                $result = createHero($_SESSION['user_id'], $hero_name, (int)$class_id);
                if (!$result) {
                    throw new Exception('Impossible de créer le héros. Veuillez vérifier les données saisies.');
                }
                
                $this->success = true;
                $this->successMessage = 'Héros créé avec succès! Vous pouvez maintenant commencer votre aventure.';
                $success = $this->success;
                $successMessage = $this->successMessage;
                $classes = getAllClasses();
                include __DIR__ . '/../Views/viewWelcome.php';
            } catch (Exception $e) {
                $this->errors[] = 'Erreur lors de la création du héros: ' . $e->getMessage();
                $errors = $this->errors;
                $success = false;
                $classes = getAllClasses();
                include __DIR__ . '/../Views/viewCreateHero.php';
            }
        }
    }
?>