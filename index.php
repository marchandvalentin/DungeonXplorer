<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <title>DungeonXPlorer - Votre Aventure Commence Ici</title>
</head>
<body class="text-medieval-cream">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="hero-card rounded-2xl p-12 md:p-16 border border-medieval-red/30 shadow-[0_8px_32px_rgba(0,0,0,0.7),inset_0_1px_0_rgba(255,255,255,0.05)] relative overflow-hidden">
            <div class="text-center space-y-6">
                <h1 class="gradient-red text-5xl md:text-7xl font-bold tracking-wider uppercase">
                    DungeonXPlorer
                </h1>
                <div class="w-32 h-1 mx-auto bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
                <p class="text-xl md:text-2xl text-medieval-lightred max-w-3xl mx-auto leading-relaxed">
                    Bienvenue dans DungeonXPlorer,<br>
                    <span class="text-medieval-cream">votre aventure médiévale fantaisie commence ici.</span>
                </p>
                <div class="flex flex-wrap justify-center gap-4 pt-8">
                    <a href="createAccount.php" class="px-8 py-4 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold text-lg tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(198,40,40,0.4)] transition-all duration-300">
                        Commencer l'Aventure
                    </a>
                    <a href="connection.php" class="px-8 py-4 bg-[rgba(42,30,20,0.5)] border-2 border-[rgba(139,40,40,0.3)] rounded-lg text-medieval-cream font-bold text-lg tracking-wide hover:bg-[rgba(139,40,40,0.3)] hover:border-medieval-red/60 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(198,40,40,0.2)] transition-all duration-300">
                        Se Connecter
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 gradient-red">
            Explorez un Monde Épique
        </h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="text-5xl mb-6">⚔️</div>
                <h3 class="text-2xl font-bold text-medieval-red mb-4">Donjons Mystérieux</h3>
                <p class="text-medieval-cream leading-relaxed">
                    Explorez des donjons remplis de trésors, de pièges mortels et de créatures légendaires. Chaque exploration est unique.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="text-5xl mb-6">🛡️</div>
                <h3 class="text-2xl font-bold text-medieval-red mb-4">Personnages Héroïques</h3>
                <p class="text-medieval-cream leading-relaxed">
                    Créez et personnalisez vos héros. Choisissez leur classe, leurs compétences et leur équipement pour affronter tous les défis.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-red/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(198,40,40,0.3)] transition-all duration-300 overflow-hidden">
                <div class="text-5xl mb-6">📜</div>
                <h3 class="text-2xl font-bold text-medieval-red mb-4">Quêtes Épiques</h3>
                <p class="text-medieval-cream leading-relaxed">
                    Accomplissez des quêtes palpitantes, forgez votre légende et devenez le héros dont le royaume a besoin.
                </p>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="max-w-7xl mx-auto px-6 py-20 mb-20">
        <div class="bg-gradient-to-r from-medieval-brown/40 via-medieval-dark/60 to-medieval-brown/40 border border-medieval-red/30 rounded-2xl p-12 text-center backdrop-blur-sm shadow-[0_8px_32px_rgba(0,0,0,0.7)]">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-medieval-lightred">
                Prêt pour l'Aventure ?
            </h2>
            <p class="text-xl text-medieval-cream mb-8 max-w-2xl mx-auto">
                Rejoignez des milliers d'aventuriers et plongez dans un monde de magie, de mystères et de batailles épiques.
            </p>
            <a href="createAccount.php" class="inline-block px-10 py-5 bg-gradient-to-r from-medieval-red/30 to-medieval-red/40 border-2 border-medieval-red text-red-300 font-bold text-xl tracking-wide rounded-lg hover:from-medieval-red/40 hover:to-medieval-red/50 hover:-translate-y-1 hover:shadow-[0_15px_40px_rgba(198,40,40,0.5)] transition-all duration-300">
                Créer Mon Compte Gratuitement
            </a>
        </div>
    </section>
    
    <?php include 'PHP/footer.php'; ?>
</body>
</html>