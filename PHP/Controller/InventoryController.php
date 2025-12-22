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
            
            header("Location: /chapter/{$hero_id}/{$chapter_id}");
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
            
            header("Location: /chapter/{$hero_id}/{$chapter_id}");
            exit();
        }
    }
}
?>