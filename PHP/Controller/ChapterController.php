<?php
    require_once __DIR__ . '/../BDD/bdd_functions.php';

    class ChapterController{
        /**
         * Displays a chapter or redirects to fight if encounter exists.
         * Checks authentication, loads hero and chapter data.
         * If an encounter exists for this chapter, redirects to the fight view.
         * Otherwise, displays the chapter content.
         * 
         * @param int $hero_id The ID of the hero viewing the chapter
         * @param int $chapter_id The ID of the chapter to display
         */
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
            
            if ($encounter) {
                // Redirect to fight
                header("Location: /fight/$hero_id/$chapter_id");
                exit;
            }
            
            include __DIR__ . '/../Views/viewChapter.php';
        }

        /**
         * Displays the fight interface for a chapter encounter.
         * Loads hero and monster data, then displays the combat view.
         * Redirects to chapter view if no monster exists.
         * 
         * @param int $hero_id The ID of the hero in combat
         * @param int $chapter_id The ID of the chapter containing the encounter
         */
        function fight($hero_id, $chapter_id){
            //if not logged in, redirect to login
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit;
            }

            $hero = getHeroById($hero_id);
            $monster = getEncounterAtChapter($chapter_id);
            $weapon1 = getWeaponById($hero['primary_weapon_item_id'] ?? -1);
            $weapon2 = getWeaponById($hero['secondary_weapon_item_id'] ?? -1);
            
            if (!$monster) {
                // No monster, redirect to chapter
                header("Location: /chapter/$hero_id/$chapter_id");
                exit;
            }
            
            // Make sure $chapter_id is available in the view
            $chapter_id = (int)$chapter_id;
            
            include __DIR__ . '/../Views/viewFight.php';
        }

        /**
         * AJAX endpoint to save combat results.
         * Receives JSON data with fight outcome, updates hero stats if victorious.
         * Awards 50 XP on victory and marks encounter as defeated.
         * 
         * Expected POST data:
         * - hero_id: int
         * - chapter_id: int
         * - victory: bool
         * - remaining_pv: int
         * - remaining_mana: int
         * 
         * @return void Outputs JSON response {"success": true}
         */
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
                // Update hero stats
                updateHeroStats($hero_id, $remaining_pv, $remaining_mana);
                
                // Award XP
                $hero = getHeroById($hero_id);
                $newXP = ($hero['xp'] ?? 0) + 50; // Award 50 XP
                updateXp($hero_id, $newXP);
            }

            echo json_encode(['success' => true]);
        }

        function showDetails($chapter_id) {
            if (!isset($_SESSION['user_id'])) {
                header('Location: /login');
                exit();
            }

            $chapter = getChapterById($chapter_id);
            
            if (!$chapter) {
                header('Location: /dashboard');
                exit();
            }

            include __DIR__ . '/../Views/viewChapterDetails.php';
        }

        function update($chapter_id) {
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

            $titre = $data['titre'] ?? null;
            $content = $data['content'] ?? null;
            $image = $data['image'] ?? '';
            $links = $data['links'] ?? [];

            if ($titre === null || $content === null) {
                echo json_encode(['success' => false, 'error' => 'Tous les champs sont requis']);
                exit;
            }

            try {
                $result = updateChapter($chapter_id, $titre, $content, $image);

                if ($result) {
                    // Update links
                    foreach ($links as $link) {
                        if (isset($link['id']) && $link['id']) {
                            // Update existing link
                            if (!empty($link['description']) || !empty($link['next_chapter_id'])) {
                                updateLink($link['id'], $link['description'], $link['next_chapter_id']);
                            }
                        } else {
                            // Create new link
                            if (!empty($link['description']) && !empty($link['next_chapter_id'])) {
                                createLink($chapter_id, $link['description'], $link['next_chapter_id']);
                            }
                        }
                    }

                    header('Content-Type: application/json');
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Erreur lors de la mise à jour']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => 'Exception: ' . $e->getMessage()]);
            }
        }

        function create() {
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

            $titre = $data['titre'] ?? null;
            $content = $data['content'] ?? null;
            $image = $data['image'] ?? '';
            $links = $data['links'] ?? [];

            if ($titre === null || $content === null) {
                echo json_encode(['success' => false, 'error' => 'Tous les champs sont requis']);
                exit;
            }

            try {
                $chapter_id = createChapter($titre, $content, $image);

                if ($chapter_id) {
                    // Create links for the new chapter
                    foreach ($links as $link) {
                        if (!empty($link['description']) && !empty($link['next_chapter_id'])) {
                            createLink($chapter_id, $link['description'], $link['next_chapter_id']);
                        }
                    }

                    header('Content-Type: application/json');
                    echo json_encode(['success' => true, 'chapter_id' => $chapter_id]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Erreur lors de la création']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => 'Exception: ' . $e->getMessage()]);
            }
        }

        function deleteLink($link_id) {
            if (!isset($_SESSION['user_id']) || $_SESSION['IS_ADMIN'] < 1) {
                http_response_code(403);
                echo json_encode(['error' => 'Unauthorized']);
                exit;
            }

            try {
                $result = deleteLink($link_id);
                if ($result) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Erreur lors de la suppression']);
                }
            } catch (Exception $e) {
                echo json_encode(['success' => false, 'error' => 'Exception: ' . $e->getMessage()]);
            }
        }
    }
?>