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
    
    <script>
        console.log(<?php echo json_encode($userProfile); ?>);
    </script>

    <!-- Profile Section -->
    <section class="max-w-4xl mx-auto px-6 py-20">
        <!-- Page Title -->
        <div class="mb-12">
            <h1 class="gradient-red text-5xl font-bold tracking-wider uppercase mb-4">
                Profil
            </h1>
            <div class="w-32 h-1 bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
        </div>

        <!-- Profile Card -->
        <div class="bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 mb-8">
            <!-- Profile Header -->
            <div class="flex items-center mb-8 pb-8 border-b border-[rgba(139,40,40,0.3)]">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-medieval-red/30 to-medieval-lightred/10 border-4 border-medieval-red/50 flex items-center justify-center text-5xl">
                    👤
                </div>
                <div class="ml-6">
                    <h2 class="text-3xl font-bold text-medieval-lightred mb-2">
                        <?php echo htmlspecialchars($userProfile['USER_NAME'] ?? 'Utilisateur'); ?>
                    </h2>
                    <p class="text-medieval-cream/70">Membre depuis <?php echo date('d/m/Y'); ?></p>
                </div>
            </div>

            <!-- Profile Info (View Mode) -->
            <div id="viewMode">
                <div class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Nom</label>
                            <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                <p class="text-medieval-cream" id="displayName"><?php echo htmlspecialchars($userProfile['USER_NAME'] ?? ''); ?></p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Email</label>
                            <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                <p class="text-medieval-cream" id="displayEmail"><?php echo htmlspecialchars($userProfile['USER_EMAIL'] ?? ''); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Account Info -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">ID de compte</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream/50">#<?php echo $userProfile['USER_ID'] ?? 'N/A'; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Edit Button -->
                <div class="mt-8">
                    <button onclick="toggleEditMode()" class="px-6 py-3 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-medieval-lightred font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 transition-all duration-300">
                        ✏️ Modifier le profil
                    </button>
                </div>

                <!-- User's Heroes Info -->
                <div>
                    <?php 
                        require_once __DIR__ . '/../BDD/bdd_functions.php';
                        $heros = getHerosByUserId($userProfile['USER_ID'] ?? 0);
                        
                        foreach ($heros as $hero):?>
                            <div class="mt-8 p-4 bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg">
                                <h3 class="text-xl font-bold text-medieval-lightred mb-2"><?php echo htmlspecialchars($hero['name'] ?? 'Héros'); ?></h3>
                                <p class="text-medieval-cream/70">Niveau: <?php echo htmlspecialchars($hero['level'] ?? 1); ?> | XP: <?php echo htmlspecialchars($hero['xp'] ?? 0); ?></p>
                            </div>
                        <?php endforeach; ?>
                </div>
            </div>

            <!-- Profile Info (Edit Mode) -->
            <div id="editMode" class="hidden">
                <form id="profileForm" onsubmit="saveProfile(event)">
                    <div class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Name Input -->
                            <div>
                                <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Nom</label>
                                <input 
                                    type="text" 
                                    id="editName" 
                                    name="name"
                                    value="<?php echo htmlspecialchars($_SESSION['user_name'] ?? ''); ?>"
                                    class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                    required
                                >
                            </div>

                            <!-- Email Input -->
                            <div>
                                <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Email</label>
                                <input 
                                    type="email" 
                                    id="editEmail" 
                                    name="email"
                                    value="<?php echo htmlspecialchars($_SESSION['user_email'] ?? ''); ?>"
                                    class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="pt-6 border-t border-[rgba(139,40,40,0.3)]">
                            <h3 class="text-xl font-bold text-medieval-lightred mb-4">Changer le mot de passe (optionnel)</h3>
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- New Password -->
                                <div>
                                    <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Nouveau mot de passe</label>
                                    <input 
                                        type="password" 
                                        id="newPassword" 
                                        name="password"
                                        placeholder="Laisser vide pour ne pas changer"
                                        class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                    >
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Confirmer le mot de passe</label>
                                    <input 
                                        type="password" 
                                        id="confirmPassword" 
                                        name="confirmPassword"
                                        placeholder="Confirmer le nouveau mot de passe"
                                        class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error/Success Messages -->
                    <div id="profileMessage" class="mt-6 hidden"></div>

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

        function saveProfile(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const password = formData.get('password');
            const confirmPassword = formData.get('confirmPassword');
            const messageDiv = document.getElementById('profileMessage');
            
            // Validate passwords if provided
            if (password && password !== confirmPassword) {
                messageDiv.className = 'mt-6 p-4 bg-red-500/20 border border-red-500/50 rounded-lg text-red-400';
                messageDiv.textContent = 'Les mots de passe ne correspondent pas.';
                messageDiv.classList.remove('hidden');
                return;
            }

            // Show loading
            messageDiv.className = 'mt-6 p-4 bg-blue-500/20 border border-blue-500/50 rounded-lg text-blue-400';
            messageDiv.textContent = 'Enregistrement en cours...';
            messageDiv.classList.remove('hidden');

            // Send update request
            fetch('/profile/update', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    name: formData.get('name'),
                    email: formData.get('email'),
                    password: password || null
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update display
                    document.getElementById('displayName').textContent = formData.get('name');
                    document.getElementById('displayEmail').textContent = formData.get('email');
                    
                    // Show success message
                    messageDiv.className = 'mt-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400';
                    messageDiv.textContent = '✓ Profil mis à jour avec succès!';
                    
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
