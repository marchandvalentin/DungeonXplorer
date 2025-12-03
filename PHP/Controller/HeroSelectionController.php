<?php

    require_once __DIR__ . '/../BDD/bdd_functions.php';

    class HeroSelectionController{
        
        /*
        [
            [user_id => '',
            id => '',
            name => '',
            hero_class => '',
            image => '',
            PV => '',
            Mana => '',
            Strength => '',
            Initiative => '',
            Spell_list => [],
            xp => '',
            level => '']
        ]
        */
        private $_Heros;

        public function isDead($hero){
            return $hero['PV'] <= 0;
        }
        
        public function getHerosByUserId($userId){
            $this->_Heros = getHerosByUserId($userId);
            return $this->_Heros;
        }

        function getHeros(){
            return $this->_Heros;
        }

        function show(){
            $heros = $this->_Heros;
            include __DIR__ . '/../Views/viewHeroSelection.php';
        }

        function showDetails($hero_id){
            $hero = getHeroById($hero_id);
            $hero['class'] = getClassById($hero['class_id']);
            include __DIR__ . '/../Views/viewHeroDetails.php';
        }

        function update($hero_id){
            if (!isset($_SESSION['user_id'])) {
                http_response_code(403);
                echo json_encode(['error' => 'Unauthorized']);
                exit;
            }

            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!$data) {
                echo json_encode(['success' => false, 'error' => 'Données invalides']);
                exit;
            }

            $xp = $data['xp'] ?? null;
            $pv = $data['pv'] ?? null;
            $strength = $data['strength'] ?? null;
            $mana = $data['mana'] ?? null;
            $initiative = $data['initiative'] ?? null;

            if ($xp === null || $pv === null || $strength === null || $mana === null || $initiative === null) {
                echo json_encode(['success' => false, 'error' => 'Tous les champs sont requis']);
                exit;
            }

            // Update hero stats
            $result = updateHeroFullStats($hero_id, $xp, $pv, $strength, $mana, $initiative);

            if ($result) {
                header('Content-Type: application/json');
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Erreur lors de la mise à jour']);
            }
        }
    }

?>