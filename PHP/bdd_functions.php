<?php
    require_once 'connexion.php';

    function getItemById($item_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM items WHERE id = :id");
        $stmt->bindParam(':id', $item_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    

    function getInventoryByHeroId($hero_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM inventory WHERE hero_id = :hero_id");
        $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    function addInInventoryWithItemName($hero_id, $item_name, $quantity) {
        global $pdo;

        //get the item id
        $stmt = $pdo->prepare("SELECT id FROM items WHERE name = :name");
        $stmt->bindParam(':name', $item_name, PDO::PARAM_STR);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        //insert into inventory
        $stmt = $pdo->prepare("INSERT INTO inventory (hero_id, item_id, quantity) VALUES (:hero_id, :item_id, :quantity)");
        $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $stmt->bindParam(':item_id', $item['id'], PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function removeFromInventoryWithItemName($hero_id, $item_name, $quantity) {
        global $pdo;

        //get the item id
        $stmt = $pdo->prepare("SELECT id FROM items WHERE name = :name");
        $stmt->bindParam(':name', $item_name, PDO::PARAM_STR);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        //remove from inventory
        $stmt = $pdo->prepare("UPDATE inventory SET quantity = quantity - :quantity WHERE hero_id = :hero_id AND item_id = :item_id");
        $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $stmt->bindParam(':item_id', $item['id'], PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        return $stmt->execute();
    }

    //HERO FUNCTIONS

    function getHeroById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM hero WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateHeroPV($hero_id, $new_health) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET health = :health WHERE id = :id");
        $stmt->bindParam(':health', $new_health, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateHeroMana($hero_id, $new_mana) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET mana = :mana WHERE id = :id");
        $stmt->bindParam(':mana', $new_mana, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateHeroStrength($hero_id, $new_strength) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET strength = :strength WHERE id = :id");
        $stmt->bindParam(':strength', $new_strength, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateHeroInitiative($hero_id, $new_initiative) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET initiative = :initiative WHERE id = :id");
        $stmt->bindParam(':initiative', $new_initiative, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function changeHeroArmorById($hero_id, $new_armor_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET armor = :armor WHERE id = :id");
        $stmt->bindParam(':armor', $new_armor_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function changePrimaryWeaponById($hero_id, $new_weapon_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET primary_weapon = :primary_weapon WHERE id = :id");
        $stmt->bindParam(':primary_weapon', $new_weapon_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function changeSecondaryWeaponById($hero_id, $new_weapon_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET secondary_weapon = :secondary_weapon WHERE id = :id");
        $stmt->bindParam(':secondary_weapon', $new_weapon_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function changeShieldById($hero_id, $new_shield_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET shield = :shield WHERE id = :id");
        $stmt->bindParam(':shield', $new_shield_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function setXp($hero_id, $new_xp) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET xp = :xp WHERE id = :id");
        $stmt->bindParam(':xp', $new_xp, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function getXp($hero_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT xp FROM hero WHERE id = :id");
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['xp'] : null;
    }

    function getHeroCurrentLevel($hero_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT level FROM hero WHERE id = :id");
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['level'] : null;
    }


    //MONSTER FUNCTIONS


    function getMonsterById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM monster WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getMonsterByName($name){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM monster WHERE name = :name");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

?>