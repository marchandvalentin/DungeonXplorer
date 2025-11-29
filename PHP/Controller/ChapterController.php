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
            
            // Check if chapter has an encounter
            $encounter = getEncounterAtChapter($chapter_id);
            if ($encounter && !isset($_SESSION['encounter_completed_' . $chapter_id])) {
                // Redirect to fight
                header("Location: /fight/$hero_id/$chapter_id");
                exit;
            }
            
            include __DIR__ . '/../Views/viewChapter.php';
        }

        function fight($hero_id, $chapter_id){
            //if not logged in, redirect to login
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit;
            }

            $hero = getHeroById($hero_id);
            $monster = getEncounterAtChapter($chapter_id);
            
            if (!$monster) {
                // No monster, redirect to chapter
                header("Location: /chapter/$hero_id/$chapter_id");
                exit;
            }
            
            // Make sure $chapter_id is available in the view
            $chapter_id = (int)$chapter_id;
            
            include __DIR__ . '/../Views/viewFight.php';
        }

        function fightResult(){
            if (!isset($_SESSION['user_id'])) {
                http_response_code(401);
                exit;
            }

            $data = json_decode(file_get_contents('php://input'), true);
            $hero_id = $data['hero_id'];
            $chapter_id = $data['chapter_id'];
            $victory = $data['victory'];
            $remaining_pv = $data['remaining_pv'];
            $remaining_mana = $data['remaining_mana'];

            if ($victory) {
                // Mark encounter as completed
                $_SESSION['encounter_completed_' . $chapter_id] = true;
                
                // Update hero stats
                updateHeroStats($hero_id, $remaining_pv, $remaining_mana);
                
                // Award XP
                $hero = getHeroById($hero_id);
                $newXP = ($hero['xp'] ?? 0) + 50; // Award 50 XP
                updateXp($hero_id, $newXP);
            }

            echo json_encode(['success' => true]);
        }
    }
?>