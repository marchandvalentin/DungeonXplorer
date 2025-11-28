<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="JS/script.js" defer></script>
    <link rel="stylesheet" href="CSS/personaliseColors.css">
    <title>Sélection de Héros - DungeonXPlorer</title>
</head>
<body class="text-medieval-cream">
    <?php include 'PHP/header.php'; ?>

    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-16">
            <h1 class="gradient-red text-5xl md:text-6xl font-bold tracking-wider uppercase mb-4">
                Vos Héros
            </h1>
            <div class="w-32 h-1 mx-auto bg-gradient-to-r from-transparent via-medieval-red to-transparent mb-6"></div>
            <p class="text-xl text-medieval-cream/80 max-w-2xl mx-auto">
                Choisissez votre champion et partez à l'aventure dans les donjons mystérieux
            </p>
        </div>

        <!-- Hero Cards Grid -->
        <?php if (!empty($heros)): ?>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <?php foreach ($heros as $hero): ?>
                    <div class="hero-save-card relative group rounded-2xl p-6 border border-medieval-red/30 shadow-[0_8px_32px_rgba(0,0,0,0.7),inset_0_1px_0_rgba(255,255,255,0.05)] overflow-hidden transition-all duration-300 hover:-translate-y-3 hover:border-medieval-red/60 hover:shadow-[0_16px_40px_rgba(198,40,40,0.4)]" style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.6), rgba(26, 22, 20, 0.8)); backdrop-filter: blur(10px);">
                        
                        <!-- Hero Header -->
                        <div class="text-center mb-6">
                            <div class="w-24 h-24 mx-auto mb-4 rounded-full bg-gradient-to-br from-medieval-red/30 to-medieval-red/10 border-2 border-medieval-red/50 flex items-center justify-center shadow-lg">
                                <span class="text-5xl">⚔️</span>
                            </div>
                            <h2 class="text-3xl font-bold text-medieval-lightred mb-2">
                                <?php echo htmlspecialchars($hero['name']); ?>
                            </h2>
                            <div class="w-16 h-0.5 mx-auto bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
                        </div>

                        <!-- Hero Stats -->
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center p-3 rounded-lg bg-[rgba(198,40,40,0.1)] border border-medieval-red/20">
                                <span class="text-medieval-cream font-semibold">PV :</span>
                                <span class="text-medieval-lightred font-bold"><?php echo htmlspecialchars($hero['pv'] ?? 0); ?></span>
                            </div>
                            
                            <div class="flex justify-between items-center p-3 rounded-lg bg-[rgba(198,40,40,0.1)] border border-medieval-red/20">
                                <span class="text-medieval-cream font-semibold">Mana :</span>
                                <span class="text-medieval-lightred font-bold"><?php echo htmlspecialchars($hero['mana'] ?? 0); ?></span>
                            </div>
                            
                            <div class="flex justify-between items-center p-3 rounded-lg bg-[rgba(198,40,40,0.1)] border border-medieval-red/20">
                                <span class="text-medieval-cream font-semibold">Force :</span>
                                <span class="text-medieval-lightred font-bold"><?php echo htmlspecialchars($hero['strength'] ?? 0); ?></span>
                            </div>

                            <div class="flex justify-between items-center p-3 rounded-lg bg-[rgba(198,40,40,0.1)] border border-medieval-red/20">
                                <span class="text-medieval-cream font-semibold">XP :</span>
                                <span class="text-yellow-400 font-bold text-lg"><?php echo htmlspecialchars($hero['xp'] ?? 0); ?></span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <button onclick="window.location.href='/chapter/<?php echo $hero['id']; ?>/1'" class="flex-1 px-4 py-3 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:scale-105 hover:shadow-[0_8px_20px_rgba(198,40,40,0.4)] transition-all duration-300">
                                Jouer
                            </button>
                            <button class="px-4 py-3 bg-[rgba(42,30,20,0.5)] border-2 border-[rgba(139,40,40,0.3)] rounded-lg text-medieval-cream font-bold hover:bg-[rgba(139,40,40,0.3)] hover:border-medieval-red/60 hover:scale-105 transition-all duration-300">
                                📊
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>

            <!-- Create New Hero Card - Only show if less than 4 heroes -->
            <?php if (count($heros) < 4): ?>
            <a href="/createHero" class="hero-save-card relative group rounded-2xl p-6 border-2 border-dashed border-medieval-red/30 shadow-[0_8px_32px_rgba(0,0,0,0.5)] overflow-hidden transition-all duration-300 hover:-translate-y-3 hover:border-medieval-red/60 hover:shadow-[0_16px_40px_rgba(198,40,40,0.3)] cursor-pointer block" style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.3), rgba(26, 22, 20, 0.5)); backdrop-filter: blur(10px);">
                <div class="flex flex-col items-center justify-center h-full min-h-[400px] text-center">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-medieval-red/20 to-medieval-red/5 border-2 border-dashed border-medieval-red/40 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <span class="text-5xl text-medieval-red/70 group-hover:text-medieval-lightred transition-colors duration-300">➕</span>
                    </div>
                    <h3 class="text-2xl font-bold text-medieval-lightred mb-3 group-hover:text-red-400 transition-colors duration-300">Créer un Nouveau Héros</h3>
                    <p class="text-medieval-cream/70 max-w-xs group-hover:text-medieval-cream transition-colors duration-300">
                        Forgez votre légende en créant un nouveau champion
                    </p>
                </div>
            </a>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <!-- Create New Hero Card - Centered when no heroes -->
        <div class="flex justify-center mb-12">
            <a href="/createHero" class="hero-save-card relative group rounded-2xl p-6 border-2 border-dashed border-medieval-red/30 shadow-[0_8px_32px_rgba(0,0,0,0.5)] overflow-hidden transition-all duration-300 hover:-translate-y-3 hover:border-medieval-red/60 hover:shadow-[0_16px_40px_rgba(198,40,40,0.3)] cursor-pointer max-w-md w-full block" style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.3), rgba(26, 22, 20, 0.5)); backdrop-filter: blur(10px);">
                <div class="flex flex-col items-center justify-center h-full min-h-[400px] text-center">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-medieval-red/20 to-medieval-red/5 border-2 border-dashed border-medieval-red/40 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <span class="text-5xl text-medieval-red/70 group-hover:text-medieval-lightred transition-colors duration-300">➕</span>
                    </div>
                    <h3 class="text-2xl font-bold text-medieval-lightred mb-3 group-hover:text-red-400 transition-colors duration-300">Créer un Nouveau Héros</h3>
                    <p class="text-medieval-cream/70 max-w-xs group-hover:text-medieval-cream transition-colors duration-300">
                        Forgez votre légende en créant un nouveau champion
                    </p>
                </div>
            </a>
        </div>
        <?php endif; ?>

        <!-- Statistics Section -->
        <div class="grid md:grid-cols-3 gap-6">
            <div class="rounded-xl p-6 border border-medieval-red/20 text-center" style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.4), rgba(26, 22, 20, 0.6)); backdrop-filter: blur(5px);">
                <div class="text-4xl font-bold text-medieval-lightred mb-2">
                    <?php echo count($heros ?? []); ?>
                </div>
                <div class="text-medieval-cream/70">Héros Actifs</div>
            </div>
            
            <div class="rounded-xl p-6 border border-medieval-red/20 text-center" style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.4), rgba(26, 22, 20, 0.6)); backdrop-filter: blur(5px);">
                <div class="text-4xl font-bold text-yellow-400 mb-2">
                    <?php 
                        $totalXP = 0;
                        foreach ($heros ?? [] as $hero) {
                            $totalXP += $hero['xp'] ?? 0;
                        }
                        echo $totalXP;
                    ?>
                </div>
                <div class="text-medieval-cream/70">XP Total</div>
            </div>
            
            <div class="rounded-xl p-6 border border-medieval-red/20 text-center" style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.4), rgba(26, 22, 20, 0.6)); backdrop-filter: blur(5px);">
                <div class="text-4xl font-bold text-red-400 mb-2">
                    <?php 
                        $totalPV = 0;
                        foreach ($heros ?? [] as $hero) {
                            $totalPV += $hero['pv'] ?? 0;
                        }
                        echo $totalPV;
                    ?>
                </div>
                <div class="text-medieval-cream/70">PV Total</div>
            </div>
        </div>
    </section>

    <?php include 'PHP/footer.php'; ?>

</body>
</html>