<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/personaliseColors.css">
    <title>DungeonXPlorer - Combat</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <section class="max-w-7xl mx-auto px-6 py-8">
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold tracking-wider uppercase mb-3">
                ⚔️ Combat ⚔️
            </h1>
            <div class="w-32 h-1 mx-auto bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
        </div>

        <!-- Combat Area -->
        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <!-- Hero Side -->
            <div class="bg-[rgba(42,30,20,0.8)] border-2 border-[rgba(139,40,40,0.4)] rounded-xl p-6 shadow-lg">
                <div class="text-center mb-6">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full bg-gradient-to-br from-blue-500/30 to-blue-700/10 border-4 border-blue-500/50 flex items-center justify-center shadow-lg">
                        <span class="text-6xl"><img src="<?php echo htmlspecialchars($hero['image']); ?>" alt="<?php echo htmlspecialchars($hero['name']); ?>" class="rounded-full w-full h-full object-cover"></span>
                    </div>
                    <h2 class="text-3xl font-bold text-blue-400 mb-2"><?php echo htmlspecialchars($hero['name']); ?></h2>
                </div>

                <!-- Hero Stats -->
                <div class="space-y-3">
                    <div class="bg-[rgba(198,40,40,0.2)] px-4 py-3 rounded-lg border border-medieval-red/20">
                        <div class="flex justify-between items-center">
                            <span class="text-medieval-cream font-semibold">PV</span>
                            <span id="hero-pv" class="text-xl font-bold text-green-400"><?php echo $hero['pv']; ?></span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-2">
                            <div id="hero-pv-bar" class="bg-green-500 h-2 rounded-full transition-all duration-500" style="width: 100%"></div>
                        </div>
                    </div>
                    
                    <div class="bg-[rgba(198,40,40,0.2)] px-4 py-3 rounded-lg border border-medieval-red/20">
                        <div class="flex justify-between items-center">
                            <span class="text-medieval-cream font-semibold">Mana</span>
                            <span id="hero-mana" class="text-xl font-bold text-blue-400"><?php echo $hero['mana']; ?></span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-2">
                            <div id="hero-mana-bar" class="bg-blue-500 h-2 rounded-full transition-all duration-500" style="width: 100%"></div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-1 bg-[rgba(198,40,40,0.2)] px-3 py-2 rounded-lg border border-medieval-red/20 text-center">
                            <div class="text-xs text-medieval-cream/60">Force</div>
                            <div class="text-lg font-bold text-red-400"><?php echo $hero['strength']; ?></div>
                        </div>
                        <div class="flex-1 bg-[rgba(198,40,40,0.2)] px-3 py-2 rounded-lg border border-medieval-red/20 text-center">
                            <div class="text-xs text-medieval-cream/60">Initiative</div>
                            <div class="text-lg font-bold text-yellow-400"><?php echo $hero['initiative']; ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monster Side -->
            <div class="bg-[rgba(42,30,20,0.8)] border-2 border-[rgba(139,40,40,0.4)] rounded-xl p-6 shadow-lg">
                <div class="text-center mb-6">
                    <div class="w-32 h-32 mx-auto mb-4 rounded-full bg-gradient-to-br from-red-500/30 to-red-700/10 border-4 border-red-500/50 flex items-center justify-center shadow-lg">
                        <span class="text-6xl"><img src="<?php echo htmlspecialchars($chapter['image']); ?>" alt="<?php echo htmlspecialchars($monster['name']); ?>" class="rounded-full w-full h-full object-cover"></span>
                    </div>
                    <h2 class="text-3xl font-bold text-red-400 mb-2"><?php echo htmlspecialchars($monster['name']); ?></h2>
                </div>

                <!-- Monster Stats -->
                <div class="space-y-3">
                    <div class="bg-[rgba(198,40,40,0.2)] px-4 py-3 rounded-lg border border-medieval-red/20">
                        <div class="flex justify-between items-center">
                            <span class="text-medieval-cream font-semibold">PV</span>
                            <span id="monster-pv" class="text-xl font-bold text-green-400"><?php echo $monster['pv']; ?></span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-2">
                            <div id="monster-pv-bar" class="bg-green-500 h-2 rounded-full transition-all duration-500" style="width: 100%"></div>
                        </div>
                    </div>
                    
                    <div class="bg-[rgba(198,40,40,0.2)] px-4 py-3 rounded-lg border border-medieval-red/20">
                        <div class="flex justify-between items-center">
                            <span class="text-medieval-cream font-semibold">Mana</span>
                            <span id="monster-mana" class="text-xl font-bold text-blue-400"><?php echo $monster['mana']; ?></span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2 mt-2">
                            <div id="monster-mana-bar" class="bg-blue-500 h-2 rounded-full transition-all duration-500" style="width: 100%"></div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="flex-1 bg-[rgba(198,40,40,0.2)] px-3 py-2 rounded-lg border border-medieval-red/20 text-center">
                            <div class="text-xs text-medieval-cream/60">Force</div>
                            <div class="text-lg font-bold text-red-400"><?php echo $monster['strength']; ?></div>
                        </div>
                        <div class="flex-1 bg-[rgba(198,40,40,0.2)] px-3 py-2 rounded-lg border border-medieval-red/20 text-center">
                            <div class="text-xs text-medieval-cream/60">Initiative</div>
                            <div class="text-lg font-bold text-yellow-400"><?php echo $monster['initiative']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Combat Log -->
        <div class="bg-[rgba(42,30,20,0.8)] border-2 border-[rgba(139,40,40,0.4)] rounded-xl p-6 shadow-lg mb-8">
            <h3 class="text-2xl font-bold text-medieval-lightred mb-4">📜 Journal de Combat</h3>
            <div id="combat-log" class="space-y-2 max-h-64 overflow-y-auto text-medieval-cream/90">
                <p class="text-center text-medieval-cream/60 italic">Le combat commence...</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div id="action-buttons" class="grid md:grid-cols-3 gap-4">
            <button id="btn-attack" class="px-6 py-4 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 transition-all duration-300">
                ⚔️ Attaque Physique
            </button>
            <button id="btn-magic" class="px-6 py-4 bg-gradient-to-r from-blue-600/20 to-blue-600/30 border-2 border-blue-500/80 rounded-lg text-blue-400 font-bold tracking-wide hover:from-blue-600/30 hover:to-blue-600/40 hover:-translate-y-1 transition-all duration-300">
                🔮 Attaque Magique
            </button>
            <button id="btn-flee" class="px-6 py-4 bg-gradient-to-r from-gray-600/20 to-gray-600/30 border-2 border-gray-500/80 rounded-lg text-gray-400 font-bold tracking-wide hover:from-gray-600/30 hover:to-gray-600/40 hover:-translate-y-1 transition-all duration-300">
                🏃 Fuir
            </button>
        </div>

        <!-- Victory/Defeat Screen (hidden by default) -->
        <div id="result-screen" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">
            <div class="bg-[rgba(42,30,20,0.95)] border-4 border-[rgba(139,40,40,0.5)] rounded-2xl p-12 max-w-2xl text-center">
                <h2 id="result-title" class="text-5xl font-bold mb-6"></h2>
                <p id="result-message" class="text-xl text-medieval-cream/90 mb-8"></p>
                <button onclick="continueAfterFight()" class="px-8 py-4 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 transition-all duration-300">
                    Continuer
                </button>
            </div>
        </div>
    </section>

    <script>
        // Pass data to fight.js
        window.heroData = {
            id: <?php echo $hero['id']; ?>,
            name: "<?php echo htmlspecialchars($hero['name']); ?>",
            pv: <?php echo $hero['pv']; ?>,
            maxPv: <?php echo $hero['pv']; ?>,
            mana: <?php echo $hero['mana']; ?>,
            maxMana: <?php echo $hero['mana']; ?>,
            strength: <?php echo $hero['strength']; ?>,
            initiative: <?php echo $hero['initiative']; ?>
        };

        window.monsterData = {
            name: "<?php echo htmlspecialchars($monster['name']); ?>",
            pv: <?php echo $monster['pv']; ?>,
            maxPv: <?php echo $monster['pv']; ?>,
            mana: <?php echo $monster['mana']; ?>,
            maxMana: <?php echo $monster['mana']; ?>,
            strength: <?php echo $monster['strength']; ?>,
            initiative: <?php echo $monster['initiative']; ?>
        };

        window.currentChapterId = <?php echo $chapter_id; ?>;
        
        window.currentChapterId = <?php echo $chapter_id; ?>;
    </script>
    
    <script src="/JS/fight.js"></script>

    <?php include 'PHP/footer.php'; ?>
</body>
</html>
