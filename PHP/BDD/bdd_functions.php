<?php
    require_once 'connexion.php';

    ////////////////// ITEM FUNCTIONS ///////////////////////

    function getItemById($item_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT i.*, t.typ_libelle as type FROM Items i JOIN Type_Item t ON (t.typ_id = i.typ_id) WHERE i.id = :id");
        $stmt->bindParam(':id', $item_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getAllItems() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Items ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function searchItemsByName($searchTerm) {
        global $pdo;
        $searchPattern = '%' . $searchTerm . '%';
        
        $stmt = $pdo->prepare(
            "   SELECT i.id as id, i.name as name, i.description as description, t.typ_libelle as type from Items i
                JOIN Type_Item t on (t.typ_id = i.typ_id)
                WHERE UPPER(i.name) like UPPER(:search);");

        $stmt->bindParam(':search', $searchPattern, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateItem($item_id, $name, $description, $type) {
        global $pdo;
        
        // Just update name and description, don't change type
        $stmt = $pdo->prepare("UPDATE Items SET name = :name, description = :description WHERE id = :id");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id', $item_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /////////////// INVENTORY FUNCTIONS ///////////////////////

    function getInventoryByHeroId($hero_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Inventory WHERE hero_id = :hero_id");
        $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    function addInInventoryWithItemName($hero_id, $item_name, $quantity) {
        global $pdo;

        //get the item id
        $stmt = $pdo->prepare("SELECT id FROM Items WHERE name = :name");
        $stmt->bindParam(':name', $item_name, PDO::PARAM_STR);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        //insert into inventory
        $stmt = $pdo->prepare("INSERT INTO Inventory (hero_id, item_id, quantity) VALUES (:hero_id, :item_id, :quantity)");
        $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $stmt->bindParam(':item_id', $item['id'], PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function removeFromInventoryWithItemName($hero_id, $item_name, $quantity) {
        global $pdo;

        //get the item id
        $stmt = $pdo->prepare("SELECT id FROM Items WHERE name = :name");
        $stmt->bindParam(':name', $item_name, PDO::PARAM_STR);
        $stmt->execute();
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        //remove from inventory
        $stmt = $pdo->prepare("UPDATE Inventory SET quantity = quantity - :quantity WHERE hero_id = :hero_id AND item_id = :item_id");
        $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $stmt->bindParam(':item_id', $item['id'], PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        return $stmt->execute();
    }

    ////////////////// HERO FUNCTIONS ///////////////////////

    function getHeroById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Hero WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getHerosByUserId($userId){
        global $pdo;
        
        $stmt = $pdo->prepare('SELECT * FROM Hero WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $heros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $heros;
    }

    function updateHeroPV($hero_id, $new_health) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET health = :health WHERE id = :id");
        $stmt->bindParam(':health', $new_health, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateHeroMana($hero_id, $new_mana) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET mana = :mana WHERE id = :id");
        $stmt->bindParam(':mana', $new_mana, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateHeroStrength($hero_id, $new_strength) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET strength = :strength WHERE id = :id");
        $stmt->bindParam(':strength', $new_strength, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateHeroInitiative($hero_id, $new_initiative) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET initiative = :initiative WHERE id = :id");
        $stmt->bindParam(':initiative', $new_initiative, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateHeroArmorById($hero_id, $new_armor_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET armor = :armor WHERE id = :id");
        $stmt->bindParam(':armor', $new_armor_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updatePrimaryWeaponById($hero_id, $new_weapon_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET primary_weapon = :primary_weapon WHERE id = :id");
        $stmt->bindParam(':primary_weapon', $new_weapon_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateSecondaryWeaponById($hero_id, $new_weapon_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET secondary_weapon = :secondary_weapon WHERE id = :id");
        $stmt->bindParam(':secondary_weapon', $new_weapon_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateShieldById($hero_id, $new_shield_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET shield = :shield WHERE id = :id");
        $stmt->bindParam(':shield', $new_shield_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateXp($hero_id, $new_xp) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET xp = :xp WHERE id = :id");
        $stmt->bindParam(':xp', $new_xp, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function getXp($hero_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT xp FROM Hero WHERE id = :id");
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['xp'] : null;
    }

    function updateHeroStats($hero_id, $pv, $mana) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET pv = :pv, mana = :mana WHERE id = :id");
        $stmt->bindParam(':pv', $pv, PDO::PARAM_INT);
        $stmt->bindParam(':mana', $mana, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateHeroFullStats($hero_id, $xp, $pv, $strength, $mana, $initiative) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Hero SET xp = :xp, pv = :pv, strength = :strength, mana = :mana, initiative = :initiative WHERE id = :id");
        $stmt->bindParam(':xp', $xp, PDO::PARAM_INT);
        $stmt->bindParam(':pv', $pv, PDO::PARAM_INT);
        $stmt->bindParam(':strength', $strength, PDO::PARAM_INT);
        $stmt->bindParam(':mana', $mana, PDO::PARAM_INT);
        $stmt->bindParam(':initiative', $initiative, PDO::PARAM_INT);
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function getHeroCurrentLevel($hero_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT level FROM Hero WHERE id = :id");
        $stmt->bindParam(':id', $hero_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['level'] : null;
    }

    // Create a new hero for a user
    function createHero($user_id, $hero_name, $class_id) {
        global $pdo;
        $created_at = date('Y-m-d H:i:s');
        
        // Get class details to set base stats
        $classStmt = $pdo->prepare("SELECT base_pv, base_mana, strength, initiative FROM Class WHERE id = :class_id");
        $classStmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
        $classStmt->execute();
        $classData = $classStmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$classData) {
            return false;
        }
        
        // Insert new hero with base stats from class
        $stmt = $pdo->prepare("INSERT INTO Hero (user_id, name, class_id, pv, mana, strength, initiative, xp, created_at) 
                              VALUES (:user_id, :name, :class_id, :pv, :mana, :strength, :initiative, :xp, :created_at)");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $hero_name, PDO::PARAM_STR);
        $stmt->bindParam(':class_id', $class_id, PDO::PARAM_INT);
        $stmt->bindValue(':pv', $classData['base_pv'], PDO::PARAM_INT);
        $stmt->bindValue(':mana', $classData['base_mana'], PDO::PARAM_INT);
        $stmt->bindValue(':strength', $classData['strength'], PDO::PARAM_INT);
        $stmt->bindValue(':initiative', $classData['initiative'], PDO::PARAM_INT);
        $stmt->bindValue(':xp', 0, PDO::PARAM_INT);
        $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
        return $stmt->execute();
    }

    ////////////////// MONSTER FUNCTIONS ///////////////////////


    function getMonsterById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Monster WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getMonsterByName($name){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Monster WHERE name = :name");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateMonsterNameById($monster_id, $new_name) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Monster SET name = :name WHERE id = :id");
        $stmt->bindParam(':name', $new_name, PDO::PARAM_STR);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterHealthById($monster_id, $new_health) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Monster SET health = :health WHERE id = :id");
        $stmt->bindParam(':health', $new_health, PDO::PARAM_INT);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterManaById($monster_id, $new_mana) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Monster SET mana = :mana WHERE id = :id");
        $stmt->bindParam(':mana', $new_mana, PDO::PARAM_INT);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterInitiativeById($monster_id, $new_initiative) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Monster SET initiative = :initiative WHERE id = :id");
        $stmt->bindParam(':initiative', $new_initiative, PDO::PARAM_INT);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterStrengthById($monster_id, $new_strength) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Monster SET strength = :strength WHERE id = :id");
        $stmt->bindParam(':strength', $new_strength, PDO::PARAM_INT);
        $stmt->bindParam(':id', $monster_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function updateMonsterAttackById($monster_id, $new_attack) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Monster SET attack = :attack WHERE id = :id");
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

        $stmt = $pdo->prepare("SELECT monster_id FROM Encounter WHERE id = :id");
        $stmt->bindParam(':id', $encounter_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $monster = getMonsterById($result['monster_id']);
        return $monster;
    }

    function getEncounterAtChapter($chapter_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT e.id, e.monster_id, m.* FROM Encounter e 
                               JOIN Monster m ON e.monster_id = m.id 
                               WHERE e.chapter_id = :chapter_id");
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getContentAndImageFromChapterId($chapter_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, titre, content, image FROM Chapter WHERE id = :id");
        $stmt->bindParam(':id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : null;
    }

    function getChapterTreasureById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT chapter_id, item_id, quantity FROM Chapter WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['treasure'] : null;
    }

    function getLinksAtChapter($chapter_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT description, next_chapter_id FROM Links WHERE chapter_id = :chapter_id");
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getLinksWithIdAtChapter($chapter_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, description, next_chapter_id FROM Links WHERE chapter_id = :chapter_id");
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function deleteLink($link_id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM Links WHERE id = :id");
        $stmt->bindParam(':id', $link_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function createLink($chapter_id, $description, $next_chapter_id) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO Links (chapter_id, description, next_chapter_id) VALUES (:chapter_id, :description, :next_chapter_id)");
        $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':next_chapter_id', $next_chapter_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return $pdo->lastInsertId();
        }
        return false;
    }

    function updateLink($link_id, $description, $next_chapter_id) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Links SET description = :description, next_chapter_id = :next_chapter_id WHERE id = :id");
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':next_chapter_id', $next_chapter_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $link_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function getAllChapters() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Chapter ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function searchChaptersById($searchTerm) {
        global $pdo;
        $searchPattern = '%' . $searchTerm . '%';
        
        $stmt = $pdo->prepare(
            "SELECT id, titre, content FROM Chapter 
             WHERE CAST(id AS CHAR) LIKE :search 
             ORDER BY id LIMIT 20;");

        $stmt->bindParam(':search', $searchPattern, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getChapterById($chapter_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM Chapter WHERE id = :id");
        $stmt->bindParam(':id', $chapter_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateChapter($chapter_id, $titre, $content, $image) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE Chapter SET titre = :titre, content = :content, image = :image WHERE id = :id");
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':id', $chapter_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    function createChapter($titre, $content, $image) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO Chapter (titre, content, image) VALUES (:titre, :content, :image)");
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return $pdo->lastInsertId();
        }
        return false;
    }

    ////////////////// PROGRESS FUNCTIONS ///////////////////////

    function saveHeroProgress($hero_id, $chapter_id, $status) {
        global $pdo;
        $isAlredaySavedStmt = $pdo->prepare("SELECT COUNT(*) FROM Hero_Progress WHERE hero_id = :hero_id");
        $isAlredaySavedStmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $isAlredaySavedStmt->execute();
        $isSaved = $isAlredaySavedStmt->fetchColumn();
        
        if($isSaved > 0){
            //update
            $stmt = $pdo->prepare("UPDATE Hero_Progress SET chapter_id = :chapter_id, status = :status WHERE hero_id = :hero_id");
            $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
            $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            return $stmt->execute();
        }else{
            $stmt = $pdo->prepare("INSERT INTO Hero_Progress (hero_id, chapter_id, status) VALUES (:hero_id, :chapter_id, :status)");
            $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
            $stmt->bindParam(':chapter_id', $chapter_id, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            return $stmt->execute();
        } 
    }

    function getHeroProgress($hero_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT chapter_id, status FROM Hero_Progress WHERE hero_id = :hero_id");
        $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
        $created_at = date('Y-m-d H:i:s');
        $stmt = $pdo->prepare("INSERT INTO Users (user_email, user_name, user_password_hash, created_at) VALUES (:user_email, :user_name, :password_hash, :created_at)");
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
        $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);
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
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If user not found, return false
        if (!$user) {
            return false;
        }
        
        // If user exists, check admin status
        if (isset($user['USER_ID'])) {
            $val_admin = $pdo->prepare("SELECT count(*) FROM admin WHERE user_id = :user_id");
            $val_admin->bindParam(':user_id', $user['USER_ID'], PDO::PARAM_INT);
            $val_admin->execute();
            $admin_result = $val_admin->fetch(PDO::FETCH_ASSOC);

            $user['IS_ADMIN'] = (isset($admin_result['count(*)']) && $admin_result['count(*)'] > 0) ? true : false;
        } else {
            $user['IS_ADMIN'] = false;
        }

        return $user;
    }

    function getUserById($user_id) {
        global $pdo;
        // Try both column name variations
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE user_id = :user_id OR USER_ID = :user_id");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If user not found, return false
        if (!$user) {
            return false;
        }

         // If user exists, check admin status
        if (isset($user['USER_ID'])) {
            $val_admin = $pdo->prepare("SELECT count(*) FROM admin WHERE user_id = :user_id");
            $val_admin->bindParam(':user_id', $user['USER_ID'], PDO::PARAM_INT);
            $val_admin->execute();
            $admin_result = $val_admin->fetch(PDO::FETCH_ASSOC);

            $user['IS_ADMIN'] = (isset($admin_result['count(*)']) && $admin_result['count(*)'] > 0) ? true : false;
        } else {
            $user['IS_ADMIN'] = false;
        }

        return $user;
    }

    function updateUserProfile($userId, $name, $email, $password = null) {
        global $pdo;
        
        if ($password) {
            // Update with password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE Users SET user_name = :name, user_email = :email, user_password_hash = :password WHERE user_id = :id");
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        } else {
            // Update without password
            $stmt = $pdo->prepare("UPDATE Users SET user_name = :name, user_email = :email WHERE user_id = :id");
        }
        
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    /////////////////////// DASHBOARD FUNCTIONS ///////////////////////

    function getAllUsers() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT count(*) FROM Users");
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['count(*)'];
    }

    function searchUsersByName($searchTerm) {
        global $pdo;
        $searchPattern = '%' . $searchTerm . '%';
        
        $stmt = $pdo->prepare(
            " SELECT u.user_id, u.user_name, u.user_email, COUNT(h.id) as hero_count FROM Users u 
              LEFT JOIN Hero h ON u.user_id = h.user_id 
              WHERE UPPER(u.user_name) LIKE UPPER(:search) 
              GROUP BY u.user_id, u.user_name, u.user_email 
              ORDER BY u.user_name LIMIT 20;");

        $stmt->bindParam(':search', $searchPattern, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function searchHeroesByName($searchTerm) {
        global $pdo;
        $searchPattern = '%' . $searchTerm . '%';
        
        $stmt = $pdo->prepare(
            " SELECT h.id as hero_id, h.name as hero_name, h.xp, h.pv, c.name as class_name, u.user_name as owner_name, u.user_id 
              FROM Hero h 
              JOIN Class c ON h.class_id = c.id 
              JOIN Users u ON h.user_id = u.user_id 
              WHERE UPPER(h.name) LIKE UPPER(:search) 
              ORDER BY h.name LIMIT 20;");

        $stmt->bindParam(':search', $searchPattern, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getActiveHeroes() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT count(*) FROM Hero");
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['count(*)'];
    }

    function completedChapters() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT count(*) FROM Hero_Progress ");
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['count(*)'];
    }

    /*function getMonstersDefeated() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT count(*) FROM Encounter WHERE defeated = 1");
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['count(*)'];
    }*/

    // Calculate percentage growth for users (this month vs last month)
    function getUsersGrowthPercentage() {
        // Placeholder until timestamp fields are added to database
        // Returns a random percentage between -10 and +30 for demonstration
        return rand(-10, 30);
    }

    // Calculate percentage growth for heroes (this week vs last week)
    function getHeroesGrowthPercentage() {
        // Placeholder until timestamp fields are added to database
        // Returns a random percentage between -5 and +20 for demonstration
        return rand(-5, 20);
    }

    // Calculate percentage growth for completed chapters (this month vs last month)
    function getCompletedChaptersGrowthPercentage() {
        // Placeholder until timestamp fields are added to database
        // Returns a random percentage between 0 and +40 for demonstration
        return rand(0, 40);
    }


    // Get monthly activity percentage (encounters completed per month)
    function getMonthlyActivityPercentage($month) {
        // Placeholder until timestamp fields are added to database
        // Returns percentages that vary by month for demonstration
        $percentages = array(75, 82, 68, 90, 55, 78, 88, 72, 85, 65, 95, 70);
        return isset($percentages[$month - 1]) ? $percentages[$month - 1] : 50;
    }

    // Calculate percentage growth for monsters defeated (this month vs last month)
    function getMonstersGrowthPercentage() {
        // Placeholder until timestamp fields are added to database
        // Returns a random percentage between +10 and +60 for demonstration
        return rand(10, 60);
    }

    // Get top heroes by experience/level
    function getTopHeroes($limit = 4) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, name, xp FROM Hero ORDER BY xp DESC LIMIT :limit");
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total chapters in the game
    function getTotalChapters() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM Chapter");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    // Get all classes from database
    function getAllClasses() {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, name, description, base_pv, base_mana, strength, initiative FROM Class ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function getClassById($class_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, name, description, base_pv, base_mana, strength, initiative FROM Class WHERE id = :id");
        $stmt->bindParam(':id', $class_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getClassByHeroId($hero_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT c.id, c.name, c.description, c.base_pv, c.base_mana, c.strength, c.initiative 
                               FROM Class c 
                               JOIN Hero h ON c.id = h.class_id 
                               WHERE h.id = :hero_id");
        $stmt->bindParam(':hero_id', $hero_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
?>