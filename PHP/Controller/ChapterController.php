<?php
    require_once __DIR__ . '/../BDD/bdd_functions.php';

    class ChapterController{
        function show($hero_id, $chapter_id){
            //if not logged in, redirect to login
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit;
            }

            $hero = getHeroById($hero_id);
            $chapter = getContentAndImageFromChapterId($chapter_id);
            
            include __DIR__ . '/../Views/viewChapter.php';
        }
    }
?>