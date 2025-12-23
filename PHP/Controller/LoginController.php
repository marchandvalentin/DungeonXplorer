<?php

    require_once __DIR__ . '/../BDD/bdd_functions.php';

    class LoginController{
        function show(){
            include __DIR__ . '/../Views/viewLogin.php';
        }

        function login(){
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = getUserByEmail($email);

            if ($user && password_verify($password, $user['USER_PASSWORD_HASH'])) {
                $_SESSION['user_id'] = $user['USER_ID'];
                $_SESSION['user_name'] = $user['USER_NAME'];
                $_SESSION['user_email'] = $user['USER_EMAIL'];
                $_SESSION['IS_ADMIN'] = $user['IS_ADMIN'] ? 1 : 0;
                include __DIR__ . '/../Views/viewWelcome.php';
            } else {
                $_SESSION['login_error'] = 'Email ou mot de passe incorrect.';
                header('Location: /login');
                exit();
            }
        }

        function logout(){
            session_unset();
            session_destroy();
            include __DIR__ . '/../Views/viewWelcome.php';
            exit();
        }
    }
?>