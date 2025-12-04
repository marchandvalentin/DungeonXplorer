<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/personaliseColors.css">
    <script src="/JS/script.js" defer></script>
    <title>DungeonXPlorer - Détails du Chapitre</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Chapter Details Section -->
    <section class="max-w-4xl mx-auto px-6 py-20">
        <!-- Page Title -->
        <div class="mb-12">
            <h1 class="gradient-red text-3xl font-bold tracking-wider uppercase mb-4">
                Détails du Chapitre
            </h1>
            <div class="w-32 h-1 bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
        </div>

        <!-- Chapter Card -->
        <div class="bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 mb-8">
            <!-- Chapter Header -->
            <div class="flex items-center mb-8 pb-8 border-b border-[rgba(139,40,40,0.3)]">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-medieval-red/30 to-medieval-lightred/10 border-4 border-medieval-red/50 flex items-center justify-center text-5xl">
                    📜
                </div>
                <div class="ml-6">
                    <h2 class="text-3xl font-bold text-medieval-lightred mb-2" id="headerTitre">
                        <?php echo htmlspecialchars($chapter['titre'] ?? 'Chapitre'); ?>
                    </h2>
                    <p class="text-medieval-cream/70">Chapitre #<?php echo $chapter['id'] ?? 'N/A'; ?></p>
                </div>
            </div>

            <!-- Chapter Info (View Mode) -->
            <div id="viewMode">
                <div class="space-y-6">
                    <!-- Titre -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Titre</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream" id="displayTitre"><?php echo htmlspecialchars($chapter['titre'] ?? 'N/A'); ?></p>
                        </div>
                    </div>

                    <!-- Content -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Contenu</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream whitespace-pre-wrap" id="displayContent"><?php echo htmlspecialchars($chapter['content'] ?? 'N/A'); ?></p>
                        </div>
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Image</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream" id="displayImage"><?php echo htmlspecialchars($chapter['image'] ?? 'Aucune image'); ?></p>
                        </div>
                    </div>

                    <!-- ID -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">ID du chapitre</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream/50">#<?php echo $chapter['id'] ?? 'N/A'; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Edit Button -->
                <?php if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']): ?>
                <div class="mt-8">
                    <button onclick="toggleEditMode()" class="px-6 py-3 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-medieval-lightred font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 transition-all duration-300">
                        ✏️ Modifier le chapitre
                    </button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Chapter Info (Edit Mode) -->
            <div id="editMode" class="hidden">
                <form id="chapterForm" onsubmit="saveChapter(event)">
                    <div class="space-y-6">
                        <!-- Titre Input -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Titre</label>
                            <input 
                                type="text" 
                                id="editTitre" 
                                name="titre"
                                value="<?php echo htmlspecialchars($chapter['titre'] ?? ''); ?>"
                                class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                required
                            >
                        </div>

                        <!-- Content Input -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Contenu</label>
                            <textarea 
                                id="editContent" 
                                name="content"
                                rows="10"
                                class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                required
                            ><?php echo htmlspecialchars($chapter['content'] ?? ''); ?></textarea>
                        </div>

                        <!-- Image Input -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Image (URL)</label>
                            <input 
                                type="text" 
                                id="editImage" 
                                name="image"
                                value="<?php echo htmlspecialchars($chapter['image'] ?? ''); ?>"
                                class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                            >
                        </div>
                    </div>

                    <!-- Error/Success Messages -->
                    <div id="chapterMessage" class="mt-6 hidden"></div>

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

        function saveChapter(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const messageDiv = document.getElementById('chapterMessage');
            
            // Show loading
            messageDiv.className = 'mt-6 p-4 bg-blue-500/20 border border-blue-500/50 rounded-lg text-blue-400';
            messageDiv.textContent = 'Enregistrement en cours...';
            messageDiv.classList.remove('hidden');

            // Send update request
            fetch('/chapter-admin/update/<?php echo $chapter['id'] ?? 0; ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    titre: formData.get('titre'),
                    content: formData.get('content'),
                    image: formData.get('image')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update display
                    document.getElementById('displayTitre').textContent = formData.get('titre');
                    document.getElementById('displayContent').textContent = formData.get('content');
                    document.getElementById('displayImage').textContent = formData.get('image') || 'Aucune image';
                    document.getElementById('headerTitre').textContent = formData.get('titre');
                    
                    // Show success message
                    messageDiv.className = 'mt-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400';
                    messageDiv.textContent = '✓ Chapitre mis à jour avec succès!';
                    
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
