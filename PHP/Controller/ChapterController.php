<?php
    class ChapterController{
        function show(){
            //if not logged in, redirect to login
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit;
            }

            include __DIR__ . '/../Views/viewChapter.php';
        }
    }
?>