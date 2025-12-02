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
    <?php 
        include 'PHP/header.php';
        require_once __DIR__ . '/../BDD/bdd_functions.php';

        // Fetch dashboard data
        $usersNumber = getAllUsers();
        $usersGrowth = getUsersGrowthPercentage();
        $activeHeroes = getActiveHeroes();
        $heroesGrowth = getHeroesGrowthPercentage();
        $completedChapterCount = completedChapters();
        $chaptersGrowth = getCompletedChaptersGrowthPercentage();
        $monsteredDefeated = 10 /*getMonstersDefeated()*/;
        $monstersGrowth = getMonstersGrowthPercentage();
        $topHeroes = getTopHeroes(4);
    ?>
    


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

        <!-- Tab Navigation -->
        <div class="mb-8 border-b border-[rgba(139,40,40,0.3)]">
            <div class="flex space-x-2">
                <button onclick="switchTab('stats')" id="tab-stats" class="tab-button active px-6 py-3 font-semibold tracking-wide transition-all duration-300">
                    📊 Statistiques
                </button>
                <button onclick="switchTab('users')" id="tab-users" class="tab-button px-6 py-3 font-semibold tracking-wide transition-all duration-300">
                    👥 Utilisateurs
                </button>
                <button onclick="switchTab('heroes')" id="tab-heroes" class="tab-button px-6 py-3 font-semibold tracking-wide transition-all duration-300">
                    ⚔️ Héros
                </button>
                <button onclick="switchTab('items')" id="tab-items" class="tab-button px-6 py-3 font-semibold tracking-wide transition-all duration-300">
                    📜 Items
                </button>
            </div>
        </div>

        <!-- Tab Content: Overview -->
        <div id="content-overview" class="tab-content">
        <!-- Statistics Cards Grid -->
        <div class="grid md:grid-cols-4 gap-6 mb-12">
            <!-- Card 1: Total Users -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-medieval-cream/70 text-sm font-semibold mb-2">Utilisateurs Totaux</p>
                        <h3 class="text-4xl font-bold text-medieval-lightred"><?php echo number_format($usersNumber); ?></h3>
                    </div>
                    <div class="text-4xl">👥</div>
                </div>
                <p class="text-medieval-cream/50 text-xs mt-4"><?php echo ($usersGrowth >= 0 ? '+' : '') . $usersGrowth; ?>% ce mois</p>
            </div>

            <!-- Card 2: Active Heroes -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-medieval-cream/70 text-sm font-semibold mb-2">Héros Actifs</p>
                        <h3 class="text-4xl font-bold text-medieval-lightred"><?php echo number_format($activeHeroes); ?></h3>
                    </div>
                    <div class="text-4xl">⚔️</div>
                </div>
                <p class="text-medieval-cream/50 text-xs mt-4"><?php echo ($heroesGrowth >= 0 ? '+' : '') . $heroesGrowth; ?>% cette semaine</p>
            </div>

            <!-- Card 3: Completed Chapters -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-medieval-cream/70 text-sm font-semibold mb-2">Chapitres Complétés</p>
                        <h3 class="text-4xl font-bold text-medieval-lightred"><?php echo number_format($completedChapterCount); ?></h3>
                    </div>
                    <div class="text-4xl">📜</div>
                </div>
                <p class="text-medieval-cream/50 text-xs mt-4"><?php echo ($chaptersGrowth >= 0 ? '+' : '') . $chaptersGrowth; ?>% ce mois</p>
            </div>

            <!-- Card 4: Monsters Defeated -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-medieval-cream/70 text-sm font-semibold mb-2">Monstres Vaincus</p>
                        <h3 class="text-4xl font-bold text-medieval-lightred"><?php echo number_format($monsteredDefeated); ?></h3>
                    </div>
                    <div class="text-4xl">👹</div>
                </div>
                <p class="text-medieval-cream/50 text-xs mt-4"><?php echo ($monstersGrowth >= 0 ? '+' : '') . $monstersGrowth; ?>% ce mois</p>
            </div>
        </div>

        <!-- Charts & Details Section -->
        <div class="grid md:grid-cols-2 gap-8 mb-12">
            <!-- Activity Chart -->
            <div class="feature-card relative bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 overflow-hidden">
                <h2 class="text-2xl font-bold text-medieval-lightred mb-6">Activité Mensuelle</h2>
                <div class="space-y-4">
                    <?php 
                    $months = array(1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre');
                    for ($i = 1; $i <= 6; $i++) {
                        $percentage = getMonthlyActivityPercentage($i);
                        $widthClass = match(true) {
                            $percentage >= 90 => 'w-11/12',
                            $percentage >= 80 => 'w-5/6',
                            $percentage >= 70 => 'w-3/4',
                            $percentage >= 60 => 'w-2/3',
                            $percentage >= 50 => 'w-1/2',
                            $percentage >= 40 => 'w-2/5',
                            $percentage >= 30 => 'w-1/3',
                            $percentage >= 20 => 'w-1/4',
                            $percentage >= 10 => 'w-1/6',
                            default => 'w-1/12'
                        };
                    ?>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-medieval-cream text-sm"><?php echo $months[$i]; ?></span>
                            <span class="text-medieval-cream/70 text-sm"><?php echo $percentage; ?>%</span>
                        </div>
                        <div class="h-2 bg-[rgba(198,40,40,0.2)] rounded-full overflow-hidden">
                            <div class="h-full <?php echo $widthClass; ?> bg-gradient-to-r from-medieval-red to-medieval-lightred transition-all duration-500"></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Top Heroes -->
            <div class="feature-card relative bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 overflow-hidden">
                <h2 class="text-2xl font-bold text-medieval-lightred mb-6">Top Héros</h2>
                <div class="space-y-4">
                    <?php 
                    $medals = array('🥇', '🥈', '🥉', '#4');
                    foreach ($topHeroes as $index => $hero): 
                    ?>
                    <div class="flex justify-between items-center p-3 bg-[rgba(198,40,40,<?php echo $index === 0 ? '0.1' : '0.05'; ?>)] rounded-lg border border-[rgba(198,40,40,<?php echo $index === 0 ? '0.2' : '0.15'; ?>)]">
                        <div>
                            <p class="text-medieval-cream font-semibold"><?php echo htmlspecialchars($hero['name']); ?></p>
                            <p class="text-medieval-cream/70 text-sm">Niveau <?php echo $hero['xp']; ?></p>
                        </div>
                        <span class="text-medieval-lightred font-bold"><?php echo $medals[$index]; ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        </div><!-- End Overview Tab -->

        <!-- Tab Content: Users -->
        <div id="content-users" class="tab-content hidden">
            <div class="bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8">
                <h2 class="text-2xl font-bold text-medieval-lightred mb-6">Cherchez un utilisateur</h2>
                
                <!-- Search Bar -->
                <div class="mb-6">
                    <div class="relative">
                        <input
                            type="text" 
                            id="userSearch" 
                            placeholder="Entrez le nom d'un utilisateur..." 
                            class="w-full px-4 py-3 pl-12 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                            onkeyup="searchUsers()"
                        >
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-xl">🔍</span>
                    </div>
                </div>

                <!-- Search Results -->
                <div id="userResults" class="space-y-3">
                    <p class="text-medieval-cream/70 text-center py-8">Entrez un nom pour rechercher...</p>
                </div>
            </div>
        </div>

        <!-- Tab Content: Heroes -->
        <div id="content-heroes" class="tab-content hidden">
            <div class="bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8">
                <h2 class="text-2xl font-bold text-medieval-lightred mb-6">Gestion des Héros</h2>
                <p class="text-medieval-cream/70">Contenu de la gestion des héros ici...</p>
            </div>
        </div>

        <!-- Tab Content: Content -->
        <div id="content-items" class="tab-content hidden">
            <div class="bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8">
                <h2 class="text-2xl font-bold text-medieval-lightred mb-6">Gestion des Items</h2>
                <p class="text-medieval-cream/70">Contenu de la gestion des items (chapitres, monstres) ici...</p>
            </div>
        </div>
    </section>

    <style>
        .tab-button {
            color: rgba(231, 211, 176, 0.7);
            border-bottom: 3px solid transparent;
        }
        .tab-button:hover {
            color: rgba(231, 211, 176, 1);
            background: rgba(198, 40, 40, 0.1);
        }
        .tab-button.active {
            color: #C62828;
            border-bottom-color: #C62828;
            background: rgba(198, 40, 40, 0.1);
        }
    </style>

    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById('content-' + tabName).classList.remove('hidden');
            
            // Add active class to clicked button
            document.getElementById('tab-' + tabName).classList.add('active');
        }

        function searchUsers() {
            const searchTerm = document.getElementById('userSearch').value.toLowerCase().trim();
            const resultsDiv = document.getElementById('userResults');
            
            if (searchTerm === '') {
                resultsDiv.innerHTML = '<p class="text-medieval-cream/70 text-center py-8">Entrez un nom pour rechercher...</p>';
                return;
            }

            // Show loading
            resultsDiv.innerHTML = '<p class="text-medieval-cream/70 text-center py-8">Recherche en cours...</p>';

            // Fetch users matching the search term
            fetch('/dashboard/search-users?name=' + encodeURIComponent(searchTerm))
                .then(response => response.json())
                .then(users => {
                    console.log('Users data:', users);
                    
                    if (users.length === 0) {
                        resultsDiv.innerHTML = '<p class="text-medieval-cream/70 text-center py-8">Aucun utilisateur trouvé.</p>';
                        return;
                    }

                    let html = '';
                    users.forEach(user => {
                        console.log('User:', user);
                        html += `
                            <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg p-4 hover:bg-[rgba(42,30,20,0.9)] hover:border-medieval-red/50 transition-all duration-300">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-medieval-cream font-semibold text-lg">${user.user_name || 'N/A'}</p>
                                        <p class="text-medieval-cream/70 text-sm">${user.user_email || 'N/A'}</p>
                                        <p class="text-medieval-cream/50 text-xs mt-1">ID: ${user.user_id || 'N/A'}</p>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <span class="text-medieval-lightred font-bold">${user.hero_count || 0} héros</span>
                                        <button class="px-4 py-2 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold text-sm tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 hover:shadow-[0_6px_20px_rgba(198,40,40,0.4)] transition-all duration-300 whitespace-nowrap"
                                                onClick="window.location.href='/profile/${user.user_id}'">
                                            Voir Profil
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    resultsDiv.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultsDiv.innerHTML = '<p class="text-red-400 text-center py-8">Erreur lors de la recherche.</p>';
                });
        }
    </script>

    <?php include 'PHP/footer.php'; ?>
</body>
</html>