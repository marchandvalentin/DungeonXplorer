<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/personaliseColors.css">
    <script src="/JS/script.js" defer></script>
    <title>DungeonXPlorer - Chapitre</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Chapter Book Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="flex gap-8 items-start">
            <!-- Hero Information Sidebar - Left Side -->
            <div class="w-80 flex-shrink-0">
                <div class="bg-[rgba(42,30,20,0.8)] border-2 border-[rgba(139,40,40,0.4)] rounded-xl p-6 shadow-lg sticky top-6">
                    <!-- Circular Health Display -->
                    <?php 
                    $pv = $hero['pv'] ?? 0;
                    $maxPv = 100; // You can adjust this or pull from DB
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
                    <div class="flex flex-col items-center gap-6">
                        <div class="relative w-32 h-32">
                            <!-- Background Circle -->
                            <svg class="transform -rotate-90 w-32 h-32">
                                <circle cx="64" cy="64" r="56" stroke="rgba(139,40,40,0.2)" stroke-width="10" fill="none"/>
                                <circle cx="64" cy="64" r="56" 
                                        stroke="<?php echo $pvColor; ?>" 
                                        stroke-width="10" 
                                        fill="none"
                                        stroke-dasharray="<?php echo 2 * M_PI * 56; ?>"
                                        stroke-dashoffset="<?php echo 2 * M_PI * 56 * (1 - $pvPercentage / 100); ?>"
                                        stroke-linecap="round"
                                        style="transition: stroke-dashoffset 0.5s ease, stroke 0.3s ease;"/>
                            </svg>
                            <!-- PV Value in Center -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-3xl font-bold" style="color: <?php echo $pvColor; ?>;">
                                        <?php echo $pv; ?>
                                    </div>
                                    <div class="text-xs text-medieval-cream/60">PV</div>
                                </div>
                            </div>
                        </div>

                        <!-- Hero Name -->
                        <div class="text-center">
                            <div class="text-xs text-medieval-cream/60">Héros</div>
                            <div class="text-2xl font-bold text-medieval-lightred"><?php echo htmlspecialchars($hero['name'] ?? 'Héros'); ?></div>
                        </div>

                        <!-- Hero Stats -->
                        <div class="w-full space-y-3">
                            <div class="bg-[rgba(198,40,40,0.2)] px-4 py-3 rounded-lg border border-medieval-red/20">
                                <div class="text-xs text-medieval-cream/60 mb-1">Mana</div>
                                <div class="text-2xl font-bold text-blue-400"><?php echo htmlspecialchars($hero['mana'] ?? 0); ?></div>
                            </div>
                            <div class="bg-[rgba(198,40,40,0.2)] px-4 py-3 rounded-lg border border-medieval-red/20">
                                <div class="text-xs text-medieval-cream/60 mb-1">Force</div>
                                <div class="text-2xl font-bold text-red-400"><?php echo htmlspecialchars($hero['strength'] ?? 0); ?></div>
                            </div>
                            <div class="bg-[rgba(198,40,40,0.2)] px-4 py-3 rounded-lg border border-medieval-red/20">
                                <div class="text-xs text-medieval-cream/60 mb-1">Expérience</div>
                                <div class="text-2xl font-bold text-yellow-400"><?php echo htmlspecialchars($hero['xp'] ?? 0); ?></div>
                            </div>
                        </div>

                        <!-- Back Button -->
                        <div class="w-full pt-4 border-t border-[rgba(139,40,40,0.3)]">
                            <a href="/heros" class="flex items-center justify-center gap-2 px-4 py-3 bg-[rgba(42,30,20,0.5)] border-2 border-[rgba(139,40,40,0.3)] rounded-lg text-medieval-cream font-bold hover:bg-[rgba(139,40,40,0.3)] hover:border-medieval-red/60 transition-all duration-300 w-full">
                                ← Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Book Container -->
            <div class="flex-1">
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
        </div>
    </section>
    
    <?php include 'PHP/footer.php'; ?>
</body>
</html>
