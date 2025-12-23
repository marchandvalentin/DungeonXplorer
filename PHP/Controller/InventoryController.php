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
            
            // Verify the hero belongs to the current user
            if (!$hero || $hero['user_id'] != $_SESSION['user_id']) {
                header('Location: /heros');
                exit();
            }

            // Get item details
            $item = getItemById($item_id);
            
            if ($item) {
                // Apply item effect based on item type
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
            
            // Verify the hero belongs to the current user
            if (!$hero || $hero['user_id'] != $_SESSION['user_id']) {
                header('Location: /heros');
                exit();
            }

            // Get item details
            $item = getItemById($item_id);
            
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
                } elseif ($itemType === 'armure') {
                    updateHeroArmorById($hero_id, $item_id);
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
            
            // Verify the hero belongs to the current user
            if (!$hero || $hero['user_id'] != $_SESSION['user_id']) {
                header('Location: /heros');
                exit();
            }

            // Get item details
            $item = getItemById($item_id);
            
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
                } elseif ($itemType === 'armure') {
                    updateHeroArmorById($hero_id, null);
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