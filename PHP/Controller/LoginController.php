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
            
             echo "<script>console.log('" . $user . "');</script>";

            if ($user && password_verify($password, $user['user_password_hash'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                echo "Bienvenue " . $user['user_name'];
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