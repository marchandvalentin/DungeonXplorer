<?php include 'PHP/header.php'; ?>

<!-- HP Full Notification Toast -->
<div id="hpNotificationToast"
    class="<?php echo (isset($_GET['notification']) && $_GET['notification'] === 'hpFull') ? '' : 'hidden'; ?> fixed top-4 sm:top-8 right-2 sm:right-8 left-2 sm:left-auto z-[9999] bg-gradient-to-br from-[rgba(42,30,20,0.95)] to-[rgba(26,22,20,0.98)] border-2 border-medieval-red/80 rounded-xl shadow-[0_10px_40px_rgba(198,40,40,0.5)] p-3 sm:p-4 sm:min-w-[300px] sm:max-w-[300px] transition-all duration-500 ease-out"
    style="<?php echo (isset($_GET['notification']) && $_GET['notification'] === 'hpFull') ? 'transform: translateX(0); opacity: 1;' : 'transform: translateX(400px); opacity: 0;'; ?>">
    <div class="flex items-center gap-3">
        <div
            class="flex-shrink-0 w-10 h-10 bg-medieval-red/30 rounded-full flex items-center justify-center border-2 border-medieval-red/60">
            <span class="text-2xl">❤️</span>
        </div>
        <div class="flex-1">
            <p class="text-medieval-cream font-bold text-sm">Votre vie est déjà pleine</p>
        </div>
        <button
            onclick="document.getElementById('hpNotificationToast').style.opacity='0'; document.getElementById('hpNotificationToast').style.transform='translateX(400px)'; setTimeout(function(){document.getElementById('hpNotificationToast').classList.add('hidden');}, 500);"
            class="flex-shrink-0 text-medieval-cream/60 hover:text-medieval-cream transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<!-- Mana Full Notification Toast -->
<div id="manaNotificationToast"
    class="<?php echo ((isset($_GET['notification']) && $_GET['notification'] === 'manaFull') || (isset($_GET['notification2']) && $_GET['notification2'] === 'manaFull')) ? '' : 'hidden'; ?> fixed <?php echo (isset($_GET['notification']) && $_GET['notification'] === 'hpFull') ? 'top-20 sm:top-28' : 'top-4 sm:top-8'; ?> right-2 sm:right-8 left-2 sm:left-auto z-[9999] bg-gradient-to-br from-[rgba(42,30,20,0.95)] to-[rgba(26,22,20,0.98)] border-2 border-blue-500/80 rounded-xl shadow-[0_10px_40px_rgba(59,130,246,0.5)] p-3 sm:p-4 sm:min-w-[300px] sm:max-w-[300px] transition-all duration-500 ease-out"
    style="<?php echo ((isset($_GET['notification']) && $_GET['notification'] === 'manaFull') || (isset($_GET['notification2']) && $_GET['notification2'] === 'manaFull')) ? 'transform: translateX(0); opacity: 1;' : 'transform: translateX(400px); opacity: 0;'; ?>">
    <div class="flex items-center gap-3">
        <div
            class="flex-shrink-0 w-10 h-10 bg-blue-500/30 rounded-full flex items-center justify-center border-2 border-blue-500/60">
            <span class="text-2xl">💙</span>
        </div>
        <div class="flex-1">
            <p class="text-medieval-cream font-bold text-sm">Votre mana est déjà plein</p>
        </div>
        <button
            onclick="document.getElementById('manaNotificationToast').style.opacity='0'; document.getElementById('manaNotificationToast').style.transform='translateX(400px)'; setTimeout(function(){document.getElementById('manaNotificationToast').classList.add('hidden');}, 500);"
            class="flex-shrink-0 text-medieval-cream/60 hover:text-medieval-cream transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<?php if (isset($_GET['notification']) && $_GET['notification'] === 'hpFull'): ?>
    <script>
        // Auto-hide HP notification after 3 seconds
        setTimeout(function () {
            var toast = document.getElementById('hpNotificationToast');
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(400px)';
            setTimeout(function () {
                toast.classList.add('hidden');
                // Clean URL without reloading
                var url = new URL(window.location);
                url.searchParams.delete('notification');
                window.history.replaceState({}, '', url.toString());
            }, 500);
        }, 3000);
    </script>
<?php endif; ?>

<?php if ((isset($_GET['notification']) && $_GET['notification'] === 'manaFull') || (isset($_GET['notification2']) && $_GET['notification2'] === 'manaFull')): ?>
    <script>
        // Auto-hide mana notification after 3 seconds
        setTimeout(function () {
            var toast = document.getElementById('manaNotificationToast');
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(400px)';
            setTimeout(function () {
                toast.classList.add('hidden');
                // Clean URL without reloading
                var url = new URL(window.location);
                url.searchParams.delete('notification');
                url.searchParams.delete('notification2');
                window.history.replaceState({}, '', url.toString());
            }, 500);
        }, 3000);
    </script>
<?php endif; ?>

<!-- Save and Quit Button -->
<div class="max-w-7xl mx-auto px-3 sm:px-6 pt-3 sm:pt-6">
    <button
        onclick="window.location.href='/save/<?php echo htmlspecialchars($hero['id']); ?>/<?php echo htmlspecialchars($chapter_id); ?>'"
        class="flex items-center justify-center gap-2 px-4 py-2 bg-[rgba(42,30,20,0.5)] border-2 border-[rgba(139,40,40,0.3)] rounded-lg text-medieval-cream text-sm font-bold hover:bg-[rgba(139,40,40,0.3)] hover:border-medieval-red/60 transition-all duration-300 w-full sm:w-auto">
        💾 Quitter et sauvegarder
    </button>
</div>

<!-- Chapter Book Section -->
<section class="max-w-7xl mx-auto px-3 sm:px-6 py-4 sm:py-8 flex-grow">
    <div class="flex flex-col lg:flex-row gap-4 sm:gap-6 items-start">
        <!-- Hero Information Sidebar - Left Side -->
        <div class="w-full lg:w-64 flex-shrink-0 space-y-4">
            <div class="bg-[rgba(42,30,20,0.8)] border-2 border-[rgba(139,40,40,0.4)] rounded-xl p-3 sm:p-4 shadow-lg">
                <!-- Circular Health Display -->
                <?php
                $pv = $hero['pv'] ?? 0;
                $maxPv = $hero['pv_max'] ?? 1;
                $pvPercentage = min(100, max(0, ($pv / $maxPv) * 100));

                // Color based on health percentage
                if ($pvPercentage > 70) {
                    $pvColor = '#10b981'; // Green
                } elseif ($pvPercentage > 40) {
                    $pvColor = '#f59e0b'; // Orange
                } elseif ($pvPercentage > 20) {
                    $pvColor = '#ef4444'; // Red
                } else {
                    $pvColor = '#991b1b'; // Dark Red
                }
                ?>
                <div class="flex flex-col sm:flex-row lg:flex-col items-center gap-4">
                    <div class="relative w-20 h-20 sm:w-24 sm:h-24">
                        <!-- Background Circle -->
                        <svg class="transform -rotate-90 w-20 h-20 sm:w-24 sm:h-24">
                            <circle cx="40" cy="40" r="32" stroke="rgba(139,40,40,0.2)" stroke-width="6" fill="none"
                                class="sm:hidden" />
                            <circle cx="48" cy="48" r="40" stroke="rgba(139,40,40,0.2)" stroke-width="8" fill="none"
                                class="hidden sm:block" />
                            <circle cx="40" cy="40" r="32" stroke="<?php echo $pvColor; ?>" stroke-width="6" fill="none"
                                stroke-dasharray="<?php echo 2 * M_PI * 32; ?>"
                                stroke-dashoffset="<?php echo 2 * M_PI * 32 * (1 - $pvPercentage / 100); ?>"
                                stroke-linecap="round"
                                style="transition: stroke-dashoffset 0.5s ease, stroke 0.3s ease;" class="sm:hidden" />
                            <circle cx="48" cy="48" r="40" stroke="<?php echo $pvColor; ?>" stroke-width="8" fill="none"
                                stroke-dasharray="<?php echo 2 * M_PI * 40; ?>"
                                stroke-dashoffset="<?php echo 2 * M_PI * 40 * (1 - $pvPercentage / 100); ?>"
                                stroke-linecap="round"
                                style="transition: stroke-dashoffset 0.5s ease, stroke 0.3s ease;"
                                class="hidden sm:block" />
                        </svg>
                        <!-- PV Value in Center -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-xl sm:text-2xl font-bold" style="color: <?php echo $pvColor; ?>;">
                                    <?php echo $pv; ?>
                                </div>
                                <div class="text-xs text-medieval-cream/60">PV</div>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Name -->
                    <div class="text-center sm:text-left lg:text-center">
                        <div class="text-xs text-medieval-cream/60">Héros</div>
                        <div class="text-lg sm:text-xl font-bold text-medieval-lightred">
                            <?php echo htmlspecialchars($hero['name'] ?? 'Héros'); ?></div>
                    </div>

                    <!-- Hero Stats -->
                    <div class="w-full grid grid-cols-3 sm:grid-cols-1 gap-2">
                        <div class="bg-[rgba(198,40,40,0.2)] px-3 py-2 rounded-lg border border-medieval-red/20">
                            <div class="text-xs text-medieval-cream/60">Mana</div>
                            <div class="text-lg font-bold text-blue-400">
                                <?php echo htmlspecialchars($hero['mana'] ?? 0); ?></div>
                        </div>
                        <div class="bg-[rgba(198,40,40,0.2)] px-3 py-2 rounded-lg border border-medieval-red/20">
                            <div class="text-xs text-medieval-cream/60">Force</div>
                            <div class="text-lg font-bold text-red-400">
                                <?php echo htmlspecialchars($hero['strength'] ?? 0); ?></div>
                        </div>
                        <div class="bg-[rgba(198,40,40,0.2)] px-3 py-2 rounded-lg border border-medieval-red/20">
                            <div class="text-xs text-medieval-cream/60">XP</div>
                            <div class="text-lg font-bold text-yellow-400">
                                <?php echo htmlspecialchars($hero['xp'] ?? 0); ?></div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="w-full pt-3 border-t border-[rgba(139,40,40,0.3)]">
                        <a href="/heros"
                            class="flex items-center justify-center gap-2 px-3 py-2 bg-[rgba(42,30,20,0.5)] border-2 border-[rgba(139,40,40,0.3)] rounded-lg text-medieval-cream text-sm font-bold hover:bg-[rgba(139,40,40,0.3)] hover:border-medieval-red/60 transition-all duration-300 w-full">
                            ← Retour
                        </a>
                    </div>
                </div>
            </div>

            <!-- Inventory Bag Image -->
            <img src="/res/sacImg/sac_fermé.png" alt="Inventory Image"
                class="mt-2 w-24 sm:w-32 lg:w-1/2 h-auto object-contain cursor-pointer rounded-lg hover:scale-105 transition-transform duration-300 mx-auto lg:mx-0"
                id="openInventoryModal">
        </div>

        <!-- Content Container -->
        <div class="flex-1 w-full">
            <div class="bg-[rgba(42,30,20,0.6)] border-2 sm:border-4 border-[rgba(139,40,40,0.5)] rounded-xl sm:rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.8)] p-4 sm:p-6 md:p-8 lg:p-12"
                style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.8), rgba(26, 22, 20, 0.9));">

                <div class="flex flex-col md:flex-row gap-4 sm:gap-6 items-start">
                    <div class="flex-1">
                        <!-- Chapter Title -->
                        <div class="mb-4 sm:mb-6 md:mb-8">
                            <h1
                                class="gradient-red text-2xl sm:text-3xl md:text-4xl font-bold tracking-wider uppercase mb-3 sm:mb-4">
                                Chapitre <?php echo htmlspecialchars($chapter['id'] ?? '1'); ?>:
                                <?php echo htmlspecialchars($chapter['titre'] ?? 'Titre du Chapitre'); ?>
                            </h1>
                            <div class="w-24 h-1 bg-gradient-to-r from-medieval-red to-transparent"></div>
                        </div>

                        <!-- Chapter Text Content -->
                        <div
                            class="text-medieval-cream/90 text-sm sm:text-base leading-relaxed space-y-3 sm:space-y-4 text-justify">
                            <?php echo nl2br(htmlspecialchars($chapter['content'] ?? 'Contenu du chapitre introuvable')); ?>
                        </div>
                    </div>

                    <!-- Chapter Image - Right Side -->
                    <div
                        class="w-full md:w-64 lg:w-80 flex-shrink-0 rounded-lg overflow-hidden border-2 border-[rgba(139,40,40,0.3)] shadow-lg">
                        <?php if ($chapter['image']):
                            echo "<script>console.log('Image path: " . addslashes($chapter['image']) . "');</script>"; endif; ?>
                        <img src="/res/Images_DungeonXplorer/Chapters/<?php echo htmlspecialchars($chapter['image'] ?? 'https://placehold.co/600x400/2d2520/e8d4b0?text=Image+du+Chapitre'); ?>"
                            alt="Illustration du chapitre" class="w-full h-auto object-cover">
                    </div>
                </div>

                <!-- Navigation Buttons at Bottom -->
                <div
                    class="mt-4 sm:mt-6 md:mt-8 pt-4 sm:pt-6 border-t border-[rgba(139,40,40,0.3)] flex flex-col sm:flex-row justify-between gap-3 sm:gap-4">

                    <?php
                    $links = getLinksAtChapter($chapter['id'] ?? 1);
                    foreach ($links as $link):
                        echo "<a href=\"/chapter/{$hero['id']}/{$link['next_chapter_id']}\" class=\"inline-flex items-center justify-center gap-2 px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold text-sm sm:text-base tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 transition-all duration-300 w-full sm:w-auto text-center\">
                                    {$link['description']}</a>";
                    endforeach;
                    ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Inventory Modal -->
<div class="hidden fixed inset-0 z-[1000] overflow-auto bg-black/70 backdrop-blur-sm" id="inventoryModal">
    <div class="min-h-screen px-2 sm:px-4 py-4 sm:py-0 flex items-center justify-center">
        <div
            class="relative bg-gradient-to-b from-[rgba(42,30,20,0.95)] to-[rgba(26,22,20,0.95)] border-2 sm:border-4 border-[rgba(139,40,40,0.6)] rounded-xl sm:rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.9)] p-4 sm:p-6 md:p-8 max-w-2xl w-full">

            <!-- Close Button -->
            <button
                class="absolute top-4 right-4 text-medieval-cream/60 hover:text-medieval-red text-4xl font-bold leading-none transition-colors duration-300 cursor-pointer"
                id="closeInventoryModal">
                &times;
            </button>

            <!-- Modal Content -->
            <div id="inventoryDetails">
                <?php
                $inventory = getInventoryByHeroID($hero['id']);
                ?>

                <h2
                    class="gradient-red text-xl sm:text-2xl md:text-3xl font-bold tracking-wider uppercase mb-4 sm:mb-6">
                    Inventaire de <?php echo htmlspecialchars($hero['name']); ?>
                </h2>

                <div class="w-24 h-1 bg-gradient-to-r from-medieval-red to-transparent mb-6"></div>

                <?php if (empty($inventory)): ?>
                    <p class="text-medieval-cream/80 text-lg text-center py-8">Votre inventaire est vide.</p>
                <?php else: ?>
                    <ul class="space-y-3">
                        <?php foreach ($inventory as $item): ?>
                            <?php $item_name = getItemById($item['item_id'])['name']; ?>
                            <li
                                class="bg-[rgba(198,40,40,0.2)] px-3 sm:px-4 py-3 rounded-lg border border-medieval-red/30 text-medieval-cream/90 hover:bg-[rgba(198,40,40,0.3)] hover:border-medieval-red/50 transition-all duration-300 flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-0">
                                <div>
                                    <span
                                        class="font-semibold text-medieval-lightred text-sm sm:text-base"><?php echo htmlspecialchars($item_name); ?></span>
                                    <span class="text-medieval-cream/60 ml-2 text-sm">×
                                        <?php echo intval($item['quantity']); ?></span>
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    <?php
                                    $itemType = getItemTypeLibelle(getItemTypeById($item['item_id']));
                                    $isEquipped = false;

                                    if ($itemType === "armure") {
                                        $isEquipped = ($hero['armor_item_id'] == $item['item_id']);
                                    } elseif ($itemType === "arme") {
                                        $isEquipped = ($hero['primary_weapon_item_id'] == $item['item_id'] || $hero['secondary_weapon_item_id'] == $item['item_id']);
                                    }

                                    if ($itemType === "armure" || $itemType === "arme"):
                                        ?>
                                        <form method="POST" action="<?php echo $isEquipped ? '/unequipItem' : '/equipItem'; ?>">
                                            <input type="hidden" name="hero_id"
                                                value="<?php echo htmlspecialchars($hero['id']); ?>">
                                            <input type="hidden" name="item_id"
                                                value="<?php echo htmlspecialchars($item['item_id']); ?>">
                                            <?php if ($isEquipped): ?>
                                                <button type="submit"
                                                    class="px-3 sm:px-4 py-2 bg-gradient-to-r from-yellow-900/20 to-yellow-800/30 border-2 border-yellow-600/80 rounded-lg text-yellow-400 font-bold text-xs sm:text-sm tracking-wide hover:from-yellow-800/30 hover:to-yellow-700/40 hover:-translate-y-0.5 transition-all duration-300 flex-1 sm:flex-none whitespace-nowrap">Déséquiper</button>
                                            <?php else: ?>
                                                <button type="submit"
                                                    class="px-3 sm:px-4 py-2 bg-gradient-to-r from-green-900/20 to-green-800/30 border-2 border-green-600/80 rounded-lg text-green-400 font-bold text-xs sm:text-sm tracking-wide hover:from-green-800/30 hover:to-green-700/40 hover:-translate-y-0.5 transition-all duration-300 flex-1 sm:flex-none whitespace-nowrap">Équiper</button>
                                            <?php endif; ?>
                                        </form>

                                    <?php elseif ($itemType === "sort"): ?>
                                        <form action="/useItem" method="POST" class="flex-1 sm:flex-none">
                                            <input type="hidden" name="hero_id"
                                                value="<?php echo htmlspecialchars($hero['id']); ?>">
                                            <input type="hidden" name="item_id"
                                                value="<?php echo htmlspecialchars($item['item_id']); ?>">
                                            <button type="submit"
                                                class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-gradient-to-r from-green-900/20 to-green-800/30 border-2 border-green-600/80 rounded-lg text-green-400 font-bold text-xs sm:text-sm tracking-wide hover:from-green-800/30 hover:to-green-700/40 hover:-translate-y-0.5 transition-all duration-300 whitespace-nowrap">Lancer</button>
                                        </form>

                                    <?php elseif ($itemType === "richesse"): ?>

                                    <?php else: ?>
                                        <form action="/useItem" method="POST" class="flex-1 sm:flex-none">
                                            <input type="hidden" name="hero_id"
                                                value="<?php echo htmlspecialchars($hero['id']); ?>">
                                            <input type="hidden" name="item_id"
                                                value="<?php echo htmlspecialchars($item['item_id']); ?>">
                                            <button type="submit"
                                                class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-gradient-to-r from-green-900/20 to-green-800/30 border-2 border-green-600/80 rounded-lg text-green-400 font-bold text-xs sm:text-sm tracking-wide hover:from-green-800/30 hover:to-green-700/40 hover:-translate-y-0.5 transition-all duration-300 whitespace-nowrap">Utiliser</button>
                                        </form>
                                    <?php endif; ?>

                                    <form action="/dropItem" method="POST" class="flex-1 sm:flex-none">
                                        <input type="hidden" name="hero_id"
                                            value="<?php echo htmlspecialchars($hero['id']); ?>">
                                        <input type="hidden" name="item_id"
                                            value="<?php echo htmlspecialchars($item['item_id']); ?>">
                                        <button type="submit"
                                            class="w-full sm:w-auto px-3 sm:px-4 py-2 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold text-xs sm:text-sm tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-0.5 transition-all duration-300 whitespace-nowrap">Jeter</button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include 'PHP/footer.php'; ?>
</body>

</html>