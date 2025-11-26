<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/personaliseColors.css">

    <title>DungeonXPlorer - Créez Votre Héros</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Create Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <!-- Page Title -->
        <div class="text-center mb-12">
            <h1 class="gradient-red text-5xl font-bold tracking-wider uppercase mb-4">
                Créez Votre Héros
            </h1>
            <div class="w-32 h-1 mx-auto bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
            <p class="text-medieval-cream/70 mt-4">Commencez votre aventure en créant votre héros personnel</p>
        </div>

        <!-- Form Card -->
        <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 overflow-hidden">
            
            <!-- Error Messages -->
            <?php if (!empty($errors) && !($success ?? false)): ?>
                <div class="bg-red-900/30 border border-red-600/50 rounded-lg p-4 space-y-2 mb-6">
                    <?php foreach ($errors as $error): ?>
                        <p class="text-red-300 text-sm">• <?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <!-- Success Message -->
            <?php if ($success ?? false): ?>
                <div class="bg-green-900/30 border border-green-600/50 rounded-lg p-4 mb-6">
                    <p class="text-green-300 text-sm"><?php echo htmlspecialchars($successMessage ?? ''); ?></p>
                    <p class="text-green-300/70 text-xs mt-2">
                        <a href="/adventures" class="text-green-400 hover:text-green-300 underline">Aller à vos aventures →</a>
                    </p>
                </div>
            <?php endif; ?>

            <form method="POST" action="/create-hero" class="space-y-8">
                <!-- Two Column Layout -->
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Left Column: Class Selection -->
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold mb-4 text-medieval-lightred">Sélectionnez Votre Classe</label>
                        <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                            <?php foreach ($classes ?? [] as $class): ?>
                                <div class="relative">
                                    <input 
                                        type="radio" 
                                        id="class_<?php echo $class['id']; ?>" 
                                        name="class_id" 
                                        value="<?php echo $class['id']; ?>"
                                        class="hidden peer"
                                        required
                                        onchange="updateClassPreview(<?php echo htmlspecialchars(json_encode($class)); ?>)"
                                    >
                                    <label for="class_<?php echo $class['id']; ?>" class="block p-3 border-2 border-[rgba(139,40,40,0.3)] rounded-lg cursor-pointer transition-all duration-300 peer-checked:border-medieval-red peer-checked:bg-[rgba(198,40,40,0.2)] hover:border-medieval-red/60">
                                        <div class="font-bold text-medieval-lightred text-sm"><?php echo htmlspecialchars($class['name']); ?></div>
                                        <div class="grid grid-cols-2 gap-1 text-xs mt-2">
                                            <div class="text-medieval-cream/60">
                                                <span class="text-medieval-lightred">PV:</span> <?php echo $class['base_pv']; ?>
                                            </div>
                                            <div class="text-medieval-cream/60">
                                                <span class="text-medieval-lightred">Mana:</span> <?php echo $class['base_mana']; ?>
                                            </div>
                                            <div class="text-medieval-cream/60">
                                                <span class="text-medieval-lightred">Force:</span> <?php echo $class['strength']; ?>
                                            </div>
                                            <div class="text-medieval-cream/60">
                                                <span class="text-medieval-lightred">Init:</span> <?php echo $class['initiative']; ?>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Right Column: Class Preview and Name Input -->
                    <div class="md:col-span-2 space-y-6">
                        <!-- Class Preview Card -->
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg p-6 text-center">
                            <div id="classPreviewContainer" class="mb-4">
                                <div class="text-6xl mb-4">🛡️</div>
                                <h3 id="classPreviewName" class="text-2xl font-bold text-medieval-lightred mb-2">Sélectionnez une classe</h3>
                                <p id="classPreviewDesc" class="text-medieval-cream/70 text-sm">Veuillez choisir une classe pour voir un aperçu</p>
                            </div>
                        </div>

                        <!-- Hero Name Input -->
                        <div>
                            <label for="hero_name" class="block text-sm font-semibold mb-3 text-medieval-lightred">Nom du Héros</label>
                            <input 
                                type="text" 
                                id="hero_name" 
                                name="hero_name" 
                                placeholder="Entrez le nom de votre héros"
                                required
                                class="form-input w-full px-4 py-3 rounded-lg transition-all duration-300 font-inter"
                                value="<?php echo htmlspecialchars($_POST['hero_name'] ?? ''); ?>"
                            >
                            <p class="text-medieval-cream/50 text-xs mt-2">Entre 2 et 50 caractères</p>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="w-full px-6 py-3 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold text-lg tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(198,40,40,0.4)] transition-all duration-300"
                    >
                        Créer Votre Héros
                    </button>
                </div>

                <!-- Back Link -->
                <div class="text-center">
                    <a href="/adventures" class="text-medieval-cream/70 hover:text-medieval-lightred transition-colors">
                        ← Retour à vos aventures
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!-- JavaScript for Dynamic Preview -->
    <script>
        function updateClassPreview(classData) {
            const classEmojis = {
                'Warrior': '⚔️',
                'Mage': '🔮',
                'Archer': '🏹',
                'Rogue': '🗡️',
                'Paladin': '✨',
                'Berserker': '💥'
            };

            const emoji = classEmojis[classData.name] || '🛡️';
            
            document.getElementById('classPreviewName').textContent = classData.name;
            document.getElementById('classPreviewDesc').innerHTML = `
                <p class="mb-3">${classData.description}</p>
                <div class="grid grid-cols-4 gap-2 text-xs mt-3">
                    <div class="bg-[rgba(198,40,40,0.2)] p-2 rounded">
                        <div class="text-medieval-lightred font-bold">${classData.base_pv}</div>
                        <div class="text-medieval-cream/60">PV</div>
                    </div>
                    <div class="bg-[rgba(198,40,40,0.2)] p-2 rounded">
                        <div class="text-medieval-lightred font-bold">${classData.base_mana}</div>
                        <div class="text-medieval-cream/60">Mana</div>
                    </div>
                    <div class="bg-[rgba(198,40,40,0.2)] p-2 rounded">
                        <div class="text-medieval-lightred font-bold">${classData.base_strength}</div>
                        <div class="text-medieval-cream/60">Force</div>
                    </div>
                    <div class="bg-[rgba(198,40,40,0.2)] p-2 rounded">
                        <div class="text-medieval-lightred font-bold">${classData.base_initiative}</div>
                        <div class="text-medieval-cream/60">Init</div>
                    </div>
                </div>
            `;
            
            document.querySelector('.text-6xl').textContent = emoji;
        }
    </script>
    
    <?php include 'PHP/footer.php'; ?>
</body>
</html>
