<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/personaliseColors.css">
    <script src="/JS/fight.js"></script>
    <title>DungeonXPlorer - Combat</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <section class="max-w-7xl mx-auto px-6 py-8">
        <div class="text-center mb-8">
            <h1 class="gradient-red text-5xl font-bold tracking-wider uppercase mb-4">
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
                        <span class="text-6xl">🛡️</span>
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
                        <span class="text-6xl">👹</span>
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
            <button onclick="playerAttack()" class="px-6 py-4 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 transition-all duration-300">
                ⚔️ Attaque Physique
            </button>
            <button onclick="playerMagicAttack()" class="px-6 py-4 bg-gradient-to-r from-blue-600/20 to-blue-600/30 border-2 border-blue-500/80 rounded-lg text-blue-400 font-bold tracking-wide hover:from-blue-600/30 hover:to-blue-600/40 hover:-translate-y-1 transition-all duration-300">
                🔮 Attaque Magique
            </button>
            <button onclick="flee()" class="px-6 py-4 bg-gradient-to-r from-gray-600/20 to-gray-600/30 border-2 border-gray-500/80 rounded-lg text-gray-400 font-bold tracking-wide hover:from-gray-600/30 hover:to-gray-600/40 hover:-translate-y-1 transition-all duration-300">
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
        // Initialize combat state
        const hero = {
            id: <?php echo $hero['id']; ?>,
            name: "<?php echo htmlspecialchars($hero['name']); ?>",
            pv: <?php echo $hero['pv']; ?>,
            maxPv: <?php echo $hero['pv']; ?>,
            mana: <?php echo $hero['mana']; ?>,
            maxMana: <?php echo $hero['mana']; ?>,
            strength: <?php echo $hero['strength']; ?>,
            initiative: <?php echo $hero['initiative']; ?>
        };

        const monster = {
            name: "<?php echo htmlspecialchars($monster['name']); ?>",
            pv: <?php echo $monster['health']; ?>,
            maxPv: <?php echo $monster['health']; ?>,
            mana: <?php echo $monster['mana']; ?>,
            maxMana: <?php echo $monster['mana']; ?>,
            strength: <?php echo $monster['strength']; ?>,
            initiative: <?php echo $monster['initiative']; ?>
        };

        const chapterId = <?php echo $chapter_id; ?>;
        let turnCount = 0;
        let isPlayerTurn = true;

        function addLog(message, type = 'normal') {
            const log = document.getElementById('combat-log');
            const p = document.createElement('p');
            p.className = type === 'damage' ? 'text-red-400' : type === 'heal' ? 'text-green-400' : 'text-medieval-cream/80';
            p.textContent = message;
            log.appendChild(p);
            log.scrollTop = log.scrollHeight;
        }

        function updateStats() {
            // Update hero
            document.getElementById('hero-pv').textContent = hero.pv;
            document.getElementById('hero-mana').textContent = hero.mana;
            const heroPvPercent = (hero.pv / hero.maxPv) * 100;
            const heroManaPercent = (hero.mana / hero.maxMana) * 100;
            document.getElementById('hero-pv-bar').style.width = heroPvPercent + '%';
            document.getElementById('hero-mana-bar').style.width = heroManaPercent + '%';

            // Update monster
            document.getElementById('monster-pv').textContent = monster.pv;
            document.getElementById('monster-mana').textContent = monster.mana;
            const monsterPvPercent = (monster.pv / monster.maxPv) * 100;
            const monsterManaPercent = (monster.mana / monster.maxMana) * 100;
            document.getElementById('monster-pv-bar').style.width = monsterPvPercent + '%';
            document.getElementById('monster-mana-bar').style.width = monsterManaPercent + '%';
        }

        function playerAttack() {
            if (!isPlayerTurn) return;
            
            const result = attackP(hero, monster);
            addLog(`${hero.name} attaque et inflige ${result.damage} dégâts!`, 'damage');
            updateStats();
            
            if (checkFightEnd()) return;
            
            isPlayerTurn = false;
            setTimeout(enemyTurn, 1500);
        }

        function playerMagicAttack() {
            if (!isPlayerTurn) return;
            
            const spell = { name: 'Boule de Feu', damage: 15, manaCost: 10 };
            const result = attackM(hero, monster, spell);
            
            if (!result.success) {
                addLog(`${hero.name} n'a pas assez de mana!`, 'normal');
                return;
            }
            
            addLog(`${hero.name} lance ${spell.name} et inflige ${result.damage} dégâts!`, 'damage');
            updateStats();
            
            if (checkFightEnd()) return;
            
            isPlayerTurn = false;
            setTimeout(enemyTurn, 1500);
        }

        function enemyTurn() {
            addLog(`C'est au tour de ${monster.name}...`, 'normal');
            
            setTimeout(() => {
                const result = attackP(monster, hero);
                addLog(`${monster.name} attaque et inflige ${result.damage} dégâts!`, 'damage');
                updateStats();
                
                if (checkFightEnd()) return;
                
                isPlayerTurn = true;
            }, 1000);
        }

        function checkFightEnd() {
            if (monster.pv <= 0) {
                showResult(true);
                return true;
            }
            if (hero.pv <= 0) {
                showResult(false);
                return true;
            }
            return false;
        }

        function showResult(victory) {
            document.getElementById('action-buttons').classList.add('hidden');
            const resultScreen = document.getElementById('result-screen');
            const resultTitle = document.getElementById('result-title');
            const resultMessage = document.getElementById('result-message');
            
            if (victory) {
                resultTitle.textContent = '🎉 Victoire! 🎉';
                resultTitle.className = 'text-5xl font-bold mb-6 text-yellow-400';
                resultMessage.textContent = `Vous avez vaincu ${monster.name}!`;
            } else {
                resultTitle.textContent = '💀 Défaite 💀';
                resultTitle.className = 'text-5xl font-bold mb-6 text-red-400';
                resultMessage.textContent = `Vous avez été vaincu par ${monster.name}...`;
            }
            
            resultScreen.classList.remove('hidden');
            
            // Save combat result to server
            saveCombatResult(victory);
        }

        function saveCombatResult(victory) {
            // Send AJAX request to save hero stats and combat result
            fetch('/fight/result', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    hero_id: hero.id,
                    chapter_id: chapterId,
                    victory: victory,
                    remaining_pv: hero.pv,
                    remaining_mana: hero.mana
                })
            });
        }

        function continueAfterFight() {
            window.location.href = `/chapter/${hero.id}/${chapterId}`;
        }

        function flee() {
            if (confirm('Êtes-vous sûr de vouloir fuir le combat?')) {
                window.location.href = `/heros`;
            }
        }

        // Initialize combat
        addLog('⚔️ Le combat commence!', 'normal');
        const firstTurn = decideTurnOrder(hero, monster);
        if (firstTurn === 'enemy') {
            isPlayerTurn = false;
            addLog(`${monster.name} a l'initiative!`, 'normal');
            setTimeout(enemyTurn, 2000);
        } else {
            addLog(`${hero.name} a l'initiative!`, 'normal');
        }
    </script>

    <?php include 'PHP/footer.php'; ?>
</body>
</html>
