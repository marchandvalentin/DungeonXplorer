<?php
require_once __DIR__ . '/../BDD/bdd_functions.php';

class InventoryController
{
    /**
     * Handles using an item from the inventory
     */
    public function useItem()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hero_id = intval($_POST['hero_id']);
            $item_id = intval($_POST['item_id']);

            // Get hero details
            $hero = getHeroById($hero_id);

            $class = getClassByHeroId($hero_id);
            
            // Verify the hero belongs to the current user
            if (!$hero || $hero['user_id'] != $_SESSION['user_id']) {
                header('Location: /heros');
                exit();
            }

            // Get item details
            $item = getItemById($item_id);
            $hpAlreadyFull = false;
            $manaAlreadyFull = false;
            $itemWasUsed = false;
            
            if ($item) {
                // Apply item effect based on item type
                $item_name = $item['name'];
                $itemProperties = getItemPropertyById($item_id);
                foreach($itemProperties as $property){
                    switch($property['prop_libelle']){
                        case 'pv':
                            if($hero['pv'] < $hero['pv_max']){
                                $new_hp =  $hero['pv'] + $property['value_of_property'];
                                updateHeroPV($hero_id, min($hero['pv_max'], $new_hp));
                                $itemWasUsed = true;
                            }
                            else{
                                // If HP is already full, mark it but continue processing other properties
                                $hpAlreadyFull = true;
                            }
                            break;
                        case 'mana':
                            if ($class['name'] !== 'Guerrier') {
                                if($hero['mana'] < $hero['mana_max']){
                                    $new_mana = $hero['mana'] + $property['value_of_property'];
                                    updateHeroMana($hero_id, min($hero['mana_max'], $new_mana));
                                    $itemWasUsed = true;
                                }
                                else{
                                    // If Mana is already full, mark it but continue processing other properties
                                    $manaAlreadyFull = true;
                                }
                            }
                            break;
                        case 'force':
                            $new_strength = $hero['strength'] + $property['value_of_property'];
                            updateHeroStrength($hero_id, $new_strength);
                            $itemWasUsed = true;
                            break;
                        case 'initiative':
                            $new_initiative = $hero['initiative'] + $property['value_of_property'];
                            updateHeroInitiative($hero_id, $new_initiative);
                            $itemWasUsed = true;
                            break;
                        case 'xp':
                            $new_xp = $hero['xp'] + $property['prop_value'];
                            updateXP($hero_id, $new_xp);
                            $itemWasUsed = true;
                            break;
                    }
                }
                
                // Only remove item from inventory if at least one property was applied
                if ($itemWasUsed) {
                    removeFromInventoryWithItemName($hero_id, $item_name, 1);
                }
            }

            // Get current chapter to redirect back
            $progress = getHeroProgress($hero_id);
            $chapter_id = $progress['chapter_id'] ?? 1;
            
            // Add notification message if HP or mana was full AND no properties were applied
            $notificationParam = '';
            if (!$itemWasUsed) {
                if ($hpAlreadyFull) {
                    $notificationParam .= '&notification=hpFull';
                }
                if ($manaAlreadyFull) {
                    $notificationParam .= ($hpAlreadyFull ? '&notification2=manaFull' : '&notification=manaFull');
                }
            }
            header("Location: /chapter/{$hero_id}/{$chapter_id}?openInventory=1{$notificationParam}");
            exit();
        }
    }

    public function equipItem(){
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hero_id = intval($_POST['hero_id']);
            $item_id = intval($_POST['item_id']);

            // Get hero details
            $hero = getHeroById($hero_id);
            $class = getClassByHeroId($hero_id);

            
            // Verify the hero belongs to the current user
            if (!$hero || $hero['user_id'] != $_SESSION['user_id']) {
                header('Location: /heros');
                exit();
            }

            // Get item details
            $item = getItemById($item_id);
            $itemProps = getItemPropertyById($item_id);
            
            if ($item) {
                // Get item type
                $itemTypeId = getItemTypeById($item_id);
                $itemType = getItemTypeLibelle($itemTypeId);
                
                // DEBUG: Check what columns hero has
                error_log("Hero columns: " . print_r(array_keys($hero), true));
                error_log("Item type: " . $itemType);
                
                // Equip the item based on type
                if ($itemType === 'arme') {
                    updatePrimaryWeaponById($hero_id, $item_id);
                }elseif($itemType === 'bouclier') {
                    updateShieldById($hero_id, $item_id);
                } elseif ($itemType === 'armure') {
                    updateHeroArmorById($hero_id, $item_id);
                }

                foreach($itemProps as $property){
                    // Skip all properties for weapons except mana
                    if($itemType === 'arme' && $property['prop_libelle'] !== 'mana') {
                        continue;
                    }
                    
                    switch($property['prop_libelle']){
                        case 'pv':
                            $new_pv_max =  $hero['pv_max'] + $property['value_of_property'];
                            updatePvMax($hero_id, $new_pv_max);
                            break;
                        case 'mana':
                            if ($class['name'] !== 'Guerrier') {
                                $new_mana = $hero['mana_max'] + $property['value_of_property'];
                                updateManaMax($hero_id, $new_mana);
                            }
                            break;
                        case 'force':
                            $new_strength = $hero['strength'] + $property['value_of_property'];
                            updateHeroStrength($hero_id, $new_strength);
                            break;
                        case 'initiative':
                            $new_initiative = $hero['initiative'] + $property['value_of_property'];
                            updateHeroInitiative($hero_id, $new_initiative);
                            break;
                        case 'xp':
                            $new_xp = $hero['xp'] + $property['prop_value'];
                            updateXP($hero_id, $new_xp);
                            break;
                    }
                }
            }

            // Get current chapter to redirect back
            $progress = getHeroProgress($hero_id);
            $chapter_id = $progress['chapter_id'] ?? 1;
            
            header("Location: /chapter/{$hero_id}/{$chapter_id}?openInventory=1");
            exit();
        }
    }

    public function unequipItem(){
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hero_id = intval($_POST['hero_id']);
            $item_id = intval($_POST['item_id']);

            // Get hero details
            $hero = getHeroById($hero_id);
            $class = getClassByHeroId($hero_id);

            
            // Verify the hero belongs to the current user
            if (!$hero || $hero['user_id'] != $_SESSION['user_id']) {
                header('Location: /heros');
                exit();
            }

            // Get item details
            $item = getItemById($item_id);
            $itemProps = getItemPropertyById($item_id);
            
            if ($item) {
                // Get item type
                $itemTypeId = getItemTypeById($item_id);
                $itemType = getItemTypeLibelle($itemTypeId);

                // Unequip the item based on type
                if ($itemType === 'arme') {
                    // Check if the item is currently equipped as primary or secondary weapon
                    if ($hero['primary_weapon_item_id'] == $item_id) {
                        updatePrimaryWeaponById($hero_id, null);
                    } elseif ($hero['secondary_weapon_item_id'] == $item_id) {
                        updateSecondaryWeaponById($hero_id, null);
                    }
                elseif($itemType === 'bouclier') {
                    updateShieldById($hero_id, null);
                }
                } elseif ($itemType === 'armure') {
                    updateHeroArmorById($hero_id, null);
                }
                
                foreach($itemProps as $property){
                    switch($property['prop_libelle']){
                        case 'pv':
                            $new_hp =  $hero['pv_max'] - $property['value_of_property'];
                            updatePvMax($hero_id, $new_hp);
                            updateHeroPV($hero_id, min($hero['pv'], $new_hp));
                            break;
                        case 'mana':
                            if ($class['name'] !== 'Guerrier') {
                                $new_mana = $hero['mana_max'] - $property['value_of_property'];
                                updateManaMax($hero_id, $new_mana);
                                updateHeroMana($hero_id, min($hero['mana'], $new_mana));
                            }
                            break;
                        case 'force':
                            $new_strength = $hero['strength'] - $property['value_of_property'];
                            updateHeroStrength($hero_id, $new_strength);
                            break;
                        case 'initiative':
                            $new_initiative = $hero['initiative'] - $property['value_of_property'];
                            updateHeroInitiative($hero_id, $new_initiative);
                            break;
                        case 'xp':
                            $new_xp = $hero['xp'] - $property['prop_value'];
                            updateXP($hero_id, $new_xp);
                            break;
                    }
                }

            }
            // Get current chapter to redirect back
            $progress = getHeroProgress($hero_id);
            $chapter_id = $progress['chapter_id'] ?? 1;
            header("Location: /chapter/{$hero_id}/{$chapter_id}?openInventory=1");
            exit();
        }
    }
    

    /**
     * Handles dropping an item from the inventory
     */
    public function dropItem()

    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hero_id = intval($_POST['hero_id']);
            $item_id = intval($_POST['item_id']);

            // Get hero details
            $hero = getHeroById($hero_id);
            
            // Verify the hero belongs to the current user
            if (!$hero || $hero['user_id'] != $_SESSION['user_id']) {
                header('Location: /heros');
                exit();
            }

            // Get item details
            $item = getItemById($item_id);
            
            if ($item) {
                $item_name = $item['name'];
                // Remove one quantity of the item from inventory
                removeFromInventoryWithItemName($hero_id, $item_name, 1);
            }

            // Get current chapter to redirect back
            $progress = getHeroProgress($hero_id);
            $chapter_id = $progress['chapter_id'] ?? 1;
            
            header("Location: /chapter/{$hero_id}/{$chapter_id}?openInventory=1");
            exit();
        }
    }
}
?>