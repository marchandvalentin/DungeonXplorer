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

            <!-- Hero Info -->
            <div class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Level -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Niveau</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream"><?php echo htmlspecialchars($hero['XP'] ?? 'N/A'); ?></p>
                        </div>
                    </div>

                    <!-- Health Points -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Points de Vie</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream"><?php echo htmlspecialchars($hero['pv'] ?? 'N/A'); ?></p>
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
                                <p class="text-medieval-cream"><?php echo htmlspecialchars($hero['strength'] ?? 'N/A'); ?></p>
                            </div>
                        </div>

                        <!-- Agility -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Mana</label>
                            <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                <p class="text-medieval-cream"><?php echo htmlspecialchars($hero['mana'] ?? 'N/A'); ?></p>
                            </div>
                        </div>

                        <!-- Intelligence -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Initiative</label>
                            <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                <p class="text-medieval-cream"><?php echo htmlspecialchars($hero['initiative'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'PHP/footer.php'; ?>
</body>
</html>