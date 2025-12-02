<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/personaliseColors.css">

    <title>DungeonXPlorer - Connexion</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Hero Details Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="max-w-md mx-auto hero-card rounded-2xl p-8 border border-medieval-red/30 shadow-[0_8px_32px_rgba(0,0,0,0.7),inset_0_1px_0_rgba(255,255,255,0.05)] relative overflow-hidden" style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.6), rgba(26, 22, 20, 0.8));">
            <div class="text-center space-y-8">
                <h1 class="gradient-red text-4xl font-bold tracking-wider uppercase">
                    Détails du Héros
                </h1>
                <div class="w-24 h-1 mx-auto bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
                
                <div class="text-left space-y-4">
                    <p><span class="font-semibold text-medieval-lightred">Nom :</span> <?php echo htmlspecialchars($hero['name'] ?? 'Inconnu'); ?></p>
                    <p><span class="font-semibold text-medieval-lightred">Classe :</span> <?php echo htmlspecialchars($hero['class'] ?? 'Inconnue'); ?></p>
                    <p><span class="font-semibold text-medieval-lightred">Niveau :</span> <?php echo htmlspecialchars($hero['level'] ?? 'N/A'); ?></p>
                    <p><span class="font-semibold text-medieval-lightred">Points de Vie :</span> <?php echo htmlspecialchars($hero['pv'] ?? 'N/A'); ?></p>
                    <p><span class="font-semibold text-medieval-lightred">Force :</span> <?php echo htmlspecialchars($hero['strength'] ?? 'N/A'); ?></p>
                    <p><span class="font-semibold text-medieval-lightred">Agilité :</span> <?php echo htmlspecialchars($hero['agility'] ?? 'N/A'); ?></p>
                    <p><span class="font-semibold text-medieval-lightred">Intelligence :</span> <?php echo htmlspecialchars($hero['intelligence'] ?? 'N/A'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'PHP/footer.php'; ?>
</body>
</html>