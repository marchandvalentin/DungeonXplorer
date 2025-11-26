<?php
    require_once 'connexion.php';

    ////////////////// ITEM FUNCTIONS ///////////////////////

    function getItemById($item_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM items WHERE id = :id");
        $stmt->bindParam(':id', $item_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /////////////// INVENTORY FUNCTIONS ///////////////////////

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

    ////////////////// HERO FUNCTIONS ///////////////////////

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

    function updateHeroArmorById($hero_id, $new_armor_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET armor = :armor WHERE id = :id");
        $stmt->bindParam(':armor', $new_armor_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updatePrimaryWeaponById($hero_id, $new_weapon_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET primary_weapon = :primary_weapon WHERE id = :id");
        $stmt->bindParam(':primary_weapon', $new_weapon_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateSecondaryWeaponById($hero_id, $new_weapon_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET secondary_weapon = :secondary_weapon WHERE id = :id");
        $stmt->bindParam(':secondary_weapon', $new_weapon_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateShieldById($hero_id, $new_shield_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE hero SET shield = :shield WHERE id = :id");
        $stmt->bindParam(':shield', $new_shield_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateXp($hero_id, $new_xp) {
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


    ////////////////// MONSTER FUNCTIONS ///////////////////////


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

    function updateMonsterNameById($monster_id, $new_name) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE monster SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $new_name, PDO::PARAM_STR);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterHealthById($monster_id, $new_health) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE monster SET health = :health WHERE id = :id");
        $stmt->bindParam(':health', $new_health, PDO::PARAM_INT);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterManaById($monster_id, $new_mana) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE monster SET mana = :mana WHERE id = :id");
        $stmt->bindParam(':mana', $new_mana, PDO::PARAM_INT);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterInitiativeById($monster_id, $new_initiative) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE monster SET initiative = :initiative WHERE id = :id");
        $stmt->bindParam(':initiative', $new_initiative, PDO::PARAM_INT);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterStrengthById($monster_id, $new_strength) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE monster SET strength = :strength WHERE id = :id");
        $stmt->bindParam(':strength', $new_strength, PDO::PARAM_INT);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterAttackById($monster_id, $new_attack) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE monster SET attack = :attack WHERE id = :id");
        $stmt->bindParam(':attack', $new_attack, PDO::PARAM_INT);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    ////////////////// CHAPTER FUNCTIONS ///////////////////////

    function isEncounterAtChapter($chapter_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM level WHERE chapter_id = :chapter_id AND has_encounter = 1");
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    function getMonsterAtEncounter($encounter_id) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT monster_id FROM encounter WHERE id = :id");
        $stmt->bindParam(':id', $encounter_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $monster = getMonsterById($result['monster_id']);
        return $monster;
    }

    function getContentAndImageFromChapterId($chapter_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT image, content FROM chapter WHERE id = :id");
        $stmt->bindParam(':id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result ? $result['image'] : null) && ($result ? $result['content'] : null);
    }

    function getChapterTreasureById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT chapter_id, item_id, quantity FROM chapter WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['treasure'] : null;
    }

    ////////////////// PROGRESS FUNCTIONS ///////////////////////

    function saveHeroProgress($hero_id, $chapter_id, $status) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO hero_progress (hero_id, chapter_id, status) VALUES (:hero_id, :chapter_id, :status)");
        $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        return $stmt->execute();
    }

    ////////////////// USER FUNCTIONS ///////////////////////

    function getUserPasswordHash($user_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT user_password_hash FROM Users WHERE user_id = :id");
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['user_password_hash'] : null;
    }

    function createUser($user_email, $user_name, $password_hash) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO Users (user_email, user_name, user_password_hash) VALUES (:user_email, :user_name, :password_hash)");
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
        return $stmt->execute();
    }


    /*
    Table user :
    - user_id (INT, PRIMARY KEY, AUTO_INCREMENT)
    - user_email (VARCHAR(255), UNIQUE)
    - user_name (VARCHAR(100))
    - user_password_hash (VARCHAR(255))
    */
    function getUserByEmail($user_email) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE user_email = :user_email");
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);
        
        $val_admin = $pdo->prepare("SELECT count(*) FROM admin WHERE user_id = :user_id");
        $val_admin->bindParam(':user_email', $stmt['USER_ID'], PDO::PARAM_STR);
        $val_admin->execute();
        $val_admin->fetch(PDO::FETCH_ASSOC);
        

        $stmt['IS_ADMIN'] = $val_admin['count(*)'] > 0 ? true : false;

        return $stmt;
    }

?>