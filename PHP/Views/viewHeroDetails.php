<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/personaliseColors.css">
    <script src="/JS/script.js" defer></script>
    <title>DungeonXPlorer - Détails du Héros</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Hero Details Section -->
    <section class="max-w-4xl mx-auto px-6 py-20">
        <!-- Page Title -->
        <div class="mb-12">
            <h1 class="gradient-red text-3xl font-bold tracking-wider uppercase mb-4">
                Détails du Héro
            </h1>
            <div class="w-32 h-1 bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
        </div>

        <!-- Hero Card -->
        <div class="bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 mb-8">
            <!-- Hero Header -->
            <div class="flex items-center mb-8 pb-8 border-b border-[rgba(139,40,40,0.3)]">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-medieval-red/30 to-medieval-lightred/10 border-4 border-medieval-red/50 flex items-center justify-center text-5xl">
                    <?php 
                        $classEmojis = [
                            'Guerrier' => '⚔️',
                            'Mage' => '🔮',
                            'Voleur' => '🗡️'
                        ];
                        $className = $hero['class']['name'] ?? '';
                        echo $classEmojis[$className] ?? '🛡️';
                    ?>
                </div>
                <div class="ml-6">
                    <h2 class="text-3xl font-bold text-medieval-lightred mb-2">
                        <?php echo htmlspecialchars($hero['name'] ?? 'Héros'); ?>
                    </h2>
                    <p class="text-medieval-cream/70"><?php echo htmlspecialchars($hero['class']['name'] ?? 'Classe inconnue'); ?></p>
                </div>
            </div>

            <!-- Hero Info (View Mode) -->
            <div id="viewMode">
                <div class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Level -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Experience</label>
                            <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                <p class="text-medieval-cream" id="displayXp"><?php echo htmlspecialchars($hero['xp'] ?? 'N/A'); ?></p>
                            </div>
                        </div>

                        <!-- Health Points -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Points de Vie</label>
                            <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                <p class="text-medieval-cream" id="displayPv"><?php echo htmlspecialchars($hero['pv'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div>
                        <h3 class="text-2xl font-bold text-medieval-lightred mb-4">Statistiques</h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <!-- Strength -->
                            <div>
                                <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Force</label>
                                <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                    <p class="text-medieval-cream" id="displayStrength"><?php echo htmlspecialchars($hero['strength'] ?? 'N/A'); ?></p>
                                </div>
                            </div>

                            <!-- Mana -->
                            <div>
                                <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Mana</label>
                                <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                    <p class="text-medieval-cream" id="displayMana"><?php echo htmlspecialchars($hero['mana'] ?? 'N/A'); ?></p>
                                </div>
                            </div>

                            <!-- Initiative -->
                            <div>
                                <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Initiative</label>
                                <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                    <p class="text-medieval-cream" id="displayInitiative"><?php echo htmlspecialchars($hero['initiative'] ?? 'N/A'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Button -->
                <div class="mt-8">
                    <button onclick="toggleEditMode()" class="px-6 py-3 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-medieval-lightred font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 transition-all duration-300">
                        ✏️ Modifier le héros
                    </button>
                </div>
            </div>

            <!-- Hero Info (Edit Mode) -->
            <div id="editMode" class="hidden">
                <form id="heroForm" onsubmit="saveHero(event)">
                    <div class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Experience Input -->
                            <div>
                                <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Experience</label>
                                <input 
                                    type="number" 
                                    id="editXp" 
                                    name="xp"
                                    value="<?php echo htmlspecialchars($hero['xp'] ?? 0); ?>"
                                    class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                    min="0"
                                    required
                                >
                            </div>

                            <!-- Health Points Input -->
                            <div>
                                <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Points de Vie</label>
                                <input 
                                    type="number" 
                                    id="editPv" 
                                    name="pv"
                                    value="<?php echo htmlspecialchars($hero['pv'] ?? 0); ?>"
                                    class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                    min="0"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Stats Section -->
                        <div class="pt-6 border-t border-[rgba(139,40,40,0.3)]">
                            <h3 class="text-xl font-bold text-medieval-lightred mb-4">Statistiques</h3>
                            <div class="grid md:grid-cols-3 gap-6">
                                <!-- Strength Input -->
                                <div>
                                    <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Force</label>
                                    <input 
                                        type="number" 
                                        id="editStrength" 
                                        name="strength"
                                        value="<?php echo htmlspecialchars($hero['strength'] ?? 0); ?>"
                                        class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                        min="0"
                                        required
                                    >
                                </div>

                                <!-- Mana Input -->
                                <div>
                                    <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Mana</label>
                                    <input 
                                        type="number" 
                                        id="editMana" 
                                        name="mana"
                                        value="<?php echo htmlspecialchars($hero['mana'] ?? 0); ?>"
                                        class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                        min="0"
                                        required
                                    >
                                </div>

                                <!-- Initiative Input -->
                                <div>
                                    <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Initiative</label>
                                    <input 
                                        type="number" 
                                        id="editInitiative" 
                                        name="initiative"
                                        value="<?php echo htmlspecialchars($hero['initiative'] ?? 0); ?>"
                                        class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                        min="0"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error/Success Messages -->
                    <div id="heroMessage" class="mt-6 hidden"></div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex gap-4">
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-600/20 to-green-600/30 border-2 border-green-500/80 rounded-lg text-green-400 font-bold tracking-wide hover:from-green-600/30 hover:to-green-600/40 hover:-translate-y-1 transition-all duration-300">
                            💾 Sauvegarder
                        </button>
                        <button type="button" onclick="toggleEditMode()" class="px-6 py-3 bg-gradient-to-r from-gray-600/20 to-gray-600/30 border-2 border-gray-500/80 rounded-lg text-gray-400 font-bold tracking-wide hover:from-gray-600/30 hover:to-gray-600/40 hover:-translate-y-1 transition-all duration-300">
                            ❌ Annuler
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function toggleEditMode() {
            const viewMode = document.getElementById('viewMode');
            const editMode = document.getElementById('editMode');
            
            if (viewMode.classList.contains('hidden')) {
                viewMode.classList.remove('hidden');
                editMode.classList.add('hidden');
            } else {
                viewMode.classList.add('hidden');
                editMode.classList.remove('hidden');
            }
        }

        function saveHero(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const messageDiv = document.getElementById('heroMessage');
            
            // Show loading
            messageDiv.className = 'mt-6 p-4 bg-blue-500/20 border border-blue-500/50 rounded-lg text-blue-400';
            messageDiv.textContent = 'Enregistrement en cours...';
            messageDiv.classList.remove('hidden');

            // Send update request
            fetch('/hero/update/<?php echo $hero['id'] ?? 0; ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    xp: parseInt(formData.get('xp')),
                    pv: parseInt(formData.get('pv')),
                    strength: parseInt(formData.get('strength')),
                    mana: parseInt(formData.get('mana')),
                    initiative: parseInt(formData.get('initiative'))
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update display
                    document.getElementById('displayXp').textContent = formData.get('xp');
                    document.getElementById('displayPv').textContent = formData.get('pv');
                    document.getElementById('displayStrength').textContent = formData.get('strength');
                    document.getElementById('displayMana').textContent = formData.get('mana');
                    document.getElementById('displayInitiative').textContent = formData.get('initiative');
                    
                    // Show success message
                    messageDiv.className = 'mt-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400';
                    messageDiv.textContent = '✓ Héros mis à jour avec succès!';
                    
                    // Switch back to view mode after 2 seconds
                    setTimeout(() => {
                        toggleEditMode();
                        messageDiv.classList.add('hidden');
                    }, 2000);
                } else {
                    messageDiv.className = 'mt-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg text-red-400';
                    messageDiv.textContent = '❌ ' + (data.error || 'Erreur lors de la mise à jour');
                }
            })
            .catch(error => {
                messageDiv.className = 'mt-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg text-red-400';
                messageDiv.textContent = '❌ Erreur de connexion';
            });
        }
    </script>

    <?php include 'PHP/footer.php'; ?>
</body>
</html>