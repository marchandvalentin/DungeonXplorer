<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/personaliseColors.css">

    <title>DungeonXPlorer - Tableau de bord</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Dashboard Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <!-- Page Title -->
        <div class="mb-12">
            <h1 class="gradient-red text-5xl font-bold tracking-wider uppercase mb-4">
                Tableau de Bord
            </h1>
            <div class="w-32 h-1 bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
            <p class="text-medieval-cream/70 mt-4">Bienvenue, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Administrateur'); ?>!</p>
        </div>

        <!-- Statistics Cards Grid -->
        <div class="grid md:grid-cols-4 gap-6 mb-12">
            <!-- Card 1: Total Users -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-medieval-cream/70 text-sm font-semibold mb-2">Utilisateurs Totaux</p>
                        <h3 class="text-4xl font-bold text-medieval-lightred">1,234</h3>
                    </div>
                    <div class="text-4xl">👥</div>
                </div>
                <p class="text-medieval-cream/50 text-xs mt-4">+12% ce mois</p>
            </div>

            <!-- Card 2: Active Heroes -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-medieval-cream/70 text-sm font-semibold mb-2">Héros Actifs</p>
                        <h3 class="text-4xl font-bold text-medieval-lightred">856</h3>
                    </div>
                    <div class="text-4xl">⚔️</div>
                </div>
                <p class="text-medieval-cream/50 text-xs mt-4">+8% cette semaine</p>
            </div>

            <!-- Card 3: Completed Quests -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-medieval-cream/70 text-sm font-semibold mb-2">Quêtes Complétées</p>
                        <h3 class="text-4xl font-bold text-medieval-lightred">5,432</h3>
                    </div>
                    <div class="text-4xl">📜</div>
                </div>
                <p class="text-medieval-cream/50 text-xs mt-4">+25% ce mois</p>
            </div>

            <!-- Card 4: Monsters Defeated -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-medieval-cream/70 text-sm font-semibold mb-2">Monstres Vaincus</p>
                        <h3 class="text-4xl font-bold text-medieval-lightred">12,891</h3>
                    </div>
                    <div class="text-4xl">👹</div>
                </div>
                <p class="text-medieval-cream/50 text-xs mt-4">+45% ce mois</p>
            </div>
        </div>

        <!-- Charts & Details Section -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <!-- Activity Chart -->
            <div class="feature-card relative bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 overflow-hidden">
                <h2 class="text-2xl font-bold text-medieval-lightred mb-6">Activité Mensuelle</h2>
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-medieval-cream text-sm">Janvier</span>
                            <span class="text-medieval-cream/70 text-sm">75%</span>
                        </div>
                        <div class="h-2 bg-[rgba(198,40,40,0.2)] rounded-full overflow-hidden">
                            <div class="h-full w-3/4 bg-gradient-to-r from-medieval-red to-medieval-lightred"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-medieval-cream text-sm">Février</span>
                            <span class="text-medieval-cream/70 text-sm">82%</span>
                        </div>
                        <div class="h-2 bg-[rgba(198,40,40,0.2)] rounded-full overflow-hidden">
                            <div class="h-full w-5/6 bg-gradient-to-r from-medieval-red to-medieval-lightred"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-medieval-cream text-sm">Mars</span>
                            <span class="text-medieval-cream/70 text-sm">68%</span>
                        </div>
                        <div class="h-2 bg-[rgba(198,40,40,0.2)] rounded-full overflow-hidden">
                            <div class="h-full w-2/3 bg-gradient-to-r from-medieval-red to-medieval-lightred"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-medieval-cream text-sm">Avril</span>
                            <span class="text-medieval-cream/70 text-sm">90%</span>
                        </div>
                        <div class="h-2 bg-[rgba(198,40,40,0.2)] rounded-full overflow-hidden">
                            <div class="h-full w-11/12 bg-gradient-to-r from-medieval-red to-medieval-lightred"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Heroes -->
            <div class="feature-card relative bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 overflow-hidden">
                <h2 class="text-2xl font-bold text-medieval-lightred mb-6">Top Héros</h2>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-[rgba(198,40,40,0.1)] rounded-lg border border-[rgba(198,40,40,0.2)]">
                        <div>
                            <p class="text-medieval-cream font-semibold">Aragorn le Vaillant</p>
                            <p class="text-medieval-cream/70 text-sm">Niveau 45</p>
                        </div>
                        <span class="text-medieval-lightred font-bold">🥇</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-[rgba(198,40,40,0.05)] rounded-lg border border-[rgba(198,40,40,0.15)]">
                        <div>
                            <p class="text-medieval-cream font-semibold">Elara la Magicienne</p>
                            <p class="text-medieval-cream/70 text-sm">Niveau 42</p>
                        </div>
                        <span class="text-medieval-cream/70 font-bold">🥈</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-[rgba(198,40,40,0.05)] rounded-lg border border-[rgba(198,40,40,0.15)]">
                        <div>
                            <p class="text-medieval-cream font-semibold">Thorin le Nain</p>
                            <p class="text-medieval-cream/70 text-sm">Niveau 40</p>
                        </div>
                        <span class="text-medieval-cream/70 font-bold">🥉</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-[rgba(198,40,40,0.05)] rounded-lg border border-[rgba(198,40,40,0.15)]">
                        <div>
                            <p class="text-medieval-cream font-semibold">Lyra l'Archer</p>
                            <p class="text-medieval-cream/70 text-sm">Niveau 38</p>
                        </div>
                        <span class="text-medieval-cream/70 font-bold">#4</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="feature-card relative bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 overflow-hidden">
            <h2 class="text-2xl font-bold text-medieval-lightred mb-6">État du Système</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-medieval-cream">Serveur Principal</span>
                        <span class="inline-block w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                    </div>
                    <p class="text-medieval-cream/70 text-sm">Opérationnel • 99.8% uptime</p>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-medieval-cream">Base de Données</span>
                        <span class="inline-block w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                    </div>
                    <p class="text-medieval-cream/70 text-sm">Opérationnel • Synchronisé</p>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="text-medieval-cream">API Externes</span>
                        <span class="inline-block w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                    </div>
                    <p class="text-medieval-cream/70 text-sm">Opérationnel • Normal</p>
                </div>
            </div>
        </div>
    </section>
    <?php include 'PHP/footer.php'; ?>
</body>
</html>