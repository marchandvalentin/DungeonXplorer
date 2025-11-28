<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/personaliseColors.css">
    <script src="JS/script.js" defer></script>
    <title>DungeonXPlorer - Chapitre</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Chapter Book Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <!-- Book Container -->
        <div class="relative max-w-6xl mx-auto">
            <!-- Open Book Layout -->
            <div class="grid md:grid-cols-2 gap-8 bg-[rgba(42,30,20,0.6)] border-4 border-[rgba(139,40,40,0.5)] rounded-2xl shadow-[0_20px_60px_rgba(0,0,0,0.8)] p-8 md:p-12" style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.8), rgba(26, 22, 20, 0.9));">
                
                <!-- Left Page -->
                <div class="border-r-2 border-[rgba(139,40,40,0.3)] pr-8 flex flex-col justify-between">
                    <div>
                        <!-- Chapter Title -->
                        <div class="mb-8">
                            <h1 class="gradient-red text-4xl font-bold tracking-wider uppercase mb-4">
                                Chapitre [Numéro]
                            </h1>
                            <div class="w-24 h-1 bg-gradient-to-r from-medieval-red to-transparent"></div>
                        </div>

                        <!-- Chapter Text Content -->
                        <div class="text-medieval-cream/90 leading-relaxed space-y-4 text-justify">
                            <p>
                                [Votre texte de chapitre ici. Description de la scène, événements, dialogues...]
                            </p>
                            <p>
                                [Suite du texte...]
                            </p>
                            <p>
                                [Texte additionnel...]
                            </p>
                        </div>
                    </div>

                    <!-- Bottom Left Navigation -->
                    <div class="mt-8 pt-6 border-t border-[rgba(139,40,40,0.3)]">
                        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 transition-all duration-300">
                            ← Choix 1
                        </a>
                    </div>
                </div>

                <!-- Right Page -->
                <div class="pl-8 flex flex-col justify-between">
                    <div>
                        <!-- Chapter Image -->
                        <div class="mb-8 rounded-lg overflow-hidden border-2 border-[rgba(139,40,40,0.3)] shadow-lg">
                            <img src="https://placehold.co/600x400/2d2520/e8d4b0?text=Image+du+Chapitre" alt="Illustration du chapitre" class="w-full h-auto object-cover">
                        </div>

                        <!-- Additional Content -->
                        <div class="text-medieval-cream/90 leading-relaxed space-y-4 text-justify">
                            <p>
                                [Suite de l'histoire ou description complémentaire...]
                            </p>
                        </div>
                    </div>

                    <!-- Bottom Right Navigation -->
                    <div class="mt-8 pt-6 border-t border-[rgba(139,40,40,0.3)] text-right">
                        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 transition-all duration-300">
                            Choix 2 →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Hero Information Bar at Bottom -->
            <div class="mt-8 bg-[rgba(42,30,20,0.8)] border-2 border-[rgba(139,40,40,0.4)] rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <!-- Hero Name -->
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-medieval-red/30 to-medieval-red/10 border-2 border-medieval-red/50 flex items-center justify-center">
                            <span class="text-3xl">⚔️</span>
                        </div>
                        <div>
                            <div class="text-xs text-medieval-cream/60">Héros</div>
                            <div class="text-xl font-bold text-medieval-lightred"><?php echo htmlspecialchars($hero['name'] ?? 'Héros'); ?></div>
                        </div>
                    </div>

                    <!-- Hero Stats -->
                    <div class="flex gap-4 flex-wrap">
                        <div class="bg-[rgba(198,40,40,0.2)] px-4 py-2 rounded-lg border border-medieval-red/20 text-center">
                            <div class="text-xs text-medieval-cream/60">PV</div>
                            <div class="text-lg font-bold text-medieval-lightred"><?php echo htmlspecialchars($hero['pv'] ?? 0); ?></div>
                        </div>
                        <div class="bg-[rgba(198,40,40,0.2)] px-4 py-2 rounded-lg border border-medieval-red/20 text-center">
                            <div class="text-xs text-medieval-cream/60">Mana</div>
                            <div class="text-lg font-bold text-medieval-lightred"><?php echo htmlspecialchars($hero['mana'] ?? 0); ?></div>
                        </div>
                        <div class="bg-[rgba(198,40,40,0.2)] px-4 py-2 rounded-lg border border-medieval-red/20 text-center">
                            <div class="text-xs text-medieval-cream/60">Force</div>
                            <div class="text-lg font-bold text-medieval-lightred"><?php echo htmlspecialchars($hero['strength'] ?? 0); ?></div>
                        </div>
                        <div class="bg-[rgba(198,40,40,0.2)] px-4 py-2 rounded-lg border border-medieval-red/20 text-center">
                            <div class="text-xs text-medieval-cream/60">XP</div>
                            <div class="text-lg font-bold text-yellow-400"><?php echo htmlspecialchars($hero['xp'] ?? 0); ?></div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div>
                        <a href="/heros" class="inline-flex items-center gap-2 px-4 py-2 bg-[rgba(42,30,20,0.5)] border-2 border-[rgba(139,40,40,0.3)] rounded-lg text-medieval-cream font-bold hover:bg-[rgba(139,40,40,0.3)] hover:border-medieval-red/60 transition-all duration-300">
                            ← Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php include 'PHP/footer.php'; ?>
</body>
</html>
