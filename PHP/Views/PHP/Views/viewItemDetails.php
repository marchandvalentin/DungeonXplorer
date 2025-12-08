<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/personaliseColors.css">
    <script src="/JS/script.js" defer></script>
    <title>DungeonXPlorer - Détails de l'Item</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Item Details Section -->
    <section class="max-w-4xl mx-auto px-6 py-20">
        <!-- Page Title -->
        <div class="mb-12">
            <h1 class="gradient-red text-3xl font-bold tracking-wider uppercase mb-4">
                Détails de l'Item
            </h1>
            <div class="w-32 h-1 bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
        </div>

        <!-- Item Card -->
        <div class="bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 mb-8">
            <!-- Item Header -->
            <div class="flex items-center mb-8 pb-8 border-b border-[rgba(139,40,40,0.3)]">
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-medieval-red/30 to-medieval-lightred/10 border-4 border-medieval-red/50 flex items-center justify-center text-5xl">
                    <?php 
                        $typeEmojis = [
                            'arme' => '⚔️',
                            'armure' => '🛡️',
                            'potion' => '🧪',
                            'sort' => '🔮',
                            'richesse' => '💎',
                        ];
                        $itemType = $item['type'] ?? '';
                        echo $typeEmojis[$itemType] ?? '📦';
                    ?>
                </div>
                <div class="ml-6">
                    <h2 class="text-3xl font-bold text-medieval-lightred mb-2" id="headerName">
                        <?php echo htmlspecialchars($item['name'] ?? 'Item'); ?>
                    </h2>
                    <p class="text-medieval-cream/70" id="headerType"><?php echo htmlspecialchars($item['type'] ?? 'Type inconnu'); ?></p>
                </div>
            </div>

            <!-- Item Info (View Mode) -->
            <div id="viewMode">
                <div class="space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Nom</label>
                            <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                <p class="text-medieval-cream" id="displayName"><?php echo htmlspecialchars($item['name'] ?? 'N/A'); ?></p>
                            </div>
                        </div>

                        <!-- Type -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Type</label>
                            <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                                <p class="text-medieval-cream" id="displayType"><?php echo htmlspecialchars($item['type'] ?? 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Description</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream" id="displayDescription"><?php echo htmlspecialchars($item['description'] ?? 'N/A'); ?></p>
                        </div>
                    </div>

                    <!-- Effect Value -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Valeur d'Effet</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream" id="displayEffectValue"><?php echo htmlspecialchars($item['effect_value'] ?? 'N/A'); ?></p>
                        </div>
                    </div>

                    <!-- ID -->
                    <div>
                        <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">ID de l'item</label>
                        <div class="bg-[rgba(42,30,20,0.7)] border border-[rgba(139,40,40,0.3)] rounded-lg px-4 py-3">
                            <p class="text-medieval-cream/50">#<?php echo $item['id'] ?? 'N/A'; ?></p>
                        </div>
                    </div>
                </div>

                <!-- Edit Button -->
                <?php if (isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN']): ?>
                <div class="mt-8">
                    <button onclick="toggleEditMode()" class="px-6 py-3 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-medieval-lightred font-bold tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 transition-all duration-300">
                        ✏️ Modifier l'item
                    </button>
                </div>
                <?php endif; ?>
            </div>

            <!-- Item Info (Edit Mode) -->
            <div id="editMode" class="hidden">
                <form id="itemForm" onsubmit="saveItem(event)">
                    <div class="space-y-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Name Input -->
                            <div>
                                <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Nom</label>
                                <input 
                                    type="text" 
                                    id="editName" 
                                    name="name"
                                    value="<?php echo htmlspecialchars($item['name'] ?? ''); ?>"
                                    class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                    required
                                >
                            </div>

                            <!-- Type Input -->
                            <div>
                                <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Type</label>
                                <select 
                                    id="editType" 
                                    name="type"
                                    class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                    required
                                >
                                    <option value="weapon" <?php echo ($item['type'] ?? '') === 'weapon' ? 'selected' : ''; ?>>Arme</option>
                                    <option value="armor" <?php echo ($item['type'] ?? '') === 'armor' ? 'selected' : ''; ?>>Armure</option>
                                    <option value="potion" <?php echo ($item['type'] ?? '') === 'potion' ? 'selected' : ''; ?>>Potion</option>
                                    <option value="consumable" <?php echo ($item['type'] ?? '') === 'consumable' ? 'selected' : ''; ?>>Consommable</option>
                                    <option value="magic" <?php echo ($item['type'] ?? '') === 'magic' ? 'selected' : ''; ?>>Magie</option>
                                    <option value="accessory" <?php echo ($item['type'] ?? '') === 'accessory' ? 'selected' : ''; ?>>Accessoire</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description Input -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Description</label>
                            <textarea 
                                id="editDescription" 
                                name="description"
                                rows="4"
                                class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                required
                            ><?php echo htmlspecialchars($item['description'] ?? ''); ?></textarea>
                        </div>

                        <!-- Effect Value Input -->
                        <div>
                            <label class="text-medieval-cream/70 text-sm font-semibold mb-2 block">Valeur d'Effet</label>
                            <input 
                                type="number" 
                                id="editEffectValue" 
                                name="effect_value"
                                value="<?php echo htmlspecialchars($item['effect_value'] ?? 0); ?>"
                                class="w-full px-4 py-3 bg-[rgba(42,30,20,0.7)] border-2 border-[rgba(139,40,40,0.4)] rounded-lg text-medieval-cream placeholder-medieval-cream/50 focus:border-medieval-red focus:outline-none transition-colors duration-300"
                                required
                            >
                        </div>
                    </div>

                    <!-- Error/Success Messages -->
                    <div id="itemMessage" class="mt-6 hidden"></div>

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

        function saveItem(event) {
            event.preventDefault();
            
            const formData = new FormData(event.target);
            const messageDiv = document.getElementById('itemMessage');
            
            // Show loading
            messageDiv.className = 'mt-6 p-4 bg-blue-500/20 border border-blue-500/50 rounded-lg text-blue-400';
            messageDiv.textContent = 'Enregistrement en cours...';
            messageDiv.classList.remove('hidden');

            // Send update request
            fetch('/item/update/<?php echo $item['id'] ?? 0; ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    name: formData.get('name'),
                    type: formData.get('type'),
                    description: formData.get('description'),
                    effect_value: parseInt(formData.get('effect_value'))
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update display (only name and description, type is not saved)
                    document.getElementById('displayName').textContent = formData.get('name');
                    document.getElementById('displayDescription').textContent = formData.get('description');
                    document.getElementById('headerName').textContent = formData.get('name');
                    
                    // Show success message
                    messageDiv.className = 'mt-6 p-4 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400';
                    messageDiv.textContent = '✓ Item mis à jour avec succès!';
                    
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
