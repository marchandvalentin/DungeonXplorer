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
            include __DIR__ . '/../Views/viewHeroSelection.php';
        }


    }


?>