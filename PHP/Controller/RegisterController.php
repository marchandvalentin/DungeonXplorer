<?php

require_once __DIR__ . '/../BDD/bdd_functions.php';

class RegisterController {
    private $errors = [];
    private $success = false;
    private $successMessage = '';

    public function show() {
        // Pass errors and success to view
        $errors = $this->errors;
        $success = $this->success;
        $successMessage = $this->successMessage;
        include __DIR__ . '/../Views/viewRegister.php';
    }

    public function register() {
        // Validate form submission
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->show();
            return;
        }

        // Get form data
        $nom = trim($_POST['nom'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        // Validate inputs
        if (empty($nom)) {
            $this->errors[] = 'Le nom est requis.';
        }
        if (empty($email)) {
            $this->errors[] = 'L\'email est requis.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'L\'email n\'est pas valide.';
        }
        if (empty($password)) {
            $this->errors[] = 'Le mot de passe est requis.';
        } elseif (strlen($password) < 6) {
            $this->errors[] = 'Le mot de passe doit contenir au moins 6 caractères.';
        }
        if ($password !== $password_confirm) {
            $this->errors[] = 'Les mots de passe ne correspondent pas.';
        }

        // If validation fails, show form with errors
        if (!empty($this->errors)) {
            $errors = $this->errors;
            $success = false;
            include __DIR__ . '/../Views/viewRegister.php';
            return;
        }

        // Check if email already exists
        $user = getUserByEmail($email);
        if ($user) {
            $this->errors[] = 'Cet email est déjà utilisé.';
            $errors = $this->errors;
            $success = false;
            include __DIR__ . '/../Views/viewRegister.php';
            return;
        }

        // Hash password and register user
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            //(createUser parameters: email, username, password_hash)
            createUser($email, $nom, $passwordHash);
            // For now, showing success. Replace with actual DB insert
            $this->success = true;
            $this->successMessage = 'Inscription réussie! Vous pouvez maintenant vous connecter.';
            $success = $this->success;
            $successMessage = $this->successMessage;
            include __DIR__ . '/../Views/viewRegister.php';
        } catch (Exception $e) {
            $this->errors[] = 'Erreur lors de l\'inscription: ' . $e->getMessage();
            $errors = $this->errors;
            $success = false;
            include __DIR__ . '/../Views/viewRegister.php';
        }
    }
}
?>