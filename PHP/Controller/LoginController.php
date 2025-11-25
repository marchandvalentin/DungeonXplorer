<?php

    require_once __DIR__ . '/../BDD/bdd_functions.php';

    class LoginController{
        function show(){
            include __DIR__ . '/../Views/viewLogin.php';
        }

        function login(){
            session_start();

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = getUserByEmail($email);

            if ($user && password_verify($password, $user['USER_PASSWORD_HASH'])) {
                $_SESSION['user_id'] = $user['USER_ID'];
                $_SESSION['user_name'] = $user['USER_NAME'];
                include __DIR__ . '/../Views/viewWelcome.php';
            } else {
                echo "Identifiants incorrects";
            }
        }

        function logout(){
            session_unset();
            session_destroy();
            echo "Vous avez été déconnecté.";
            header("Location: index.php");
            exit();
        }
    }
?>