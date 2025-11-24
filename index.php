<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        medieval: {
                            dark: '#1a1614',
                            brown: '#2d2520',
                            gold: '#d4af37',
                            lightgold: '#f4e5c3',
                            cream: '#e8d4b0',
                        }
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-gold {
            background: linear-gradient(135deg, #d4af37 0%, #f4e5c3 50%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .hero-card {
            background: linear-gradient(135deg, rgba(42, 30, 20, 0.6), rgba(26, 22, 20, 0.8));
            backdrop-filter: blur(10px);
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.1), transparent);
            transition: left 0.6s ease;
        }
        
        .feature-card:hover::before {
            left: 100%;
        }
        
        .navbar-gradient {
            background: linear-gradient(135deg, #1a1614 0%, #2d2520 50%, #1a1614 100%);
        }
        
        .navbar-top-line::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
            opacity: 0.5;
        }
        
        .logo-underline::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
            opacity: 0.5;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .nav-link:hover::before {
            left: 100%;
        }
        
        .nav-link-active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
        }
    </style>
    <title>DungeonXPlorer - Votre Aventure Commence Ici</title>
</head>
<body class="text-medieval-cream">
    <?php include 'PHP/header.php'; ?>
    
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="hero-card rounded-2xl p-12 md:p-16 border border-medieval-gold/30 shadow-[0_8px_32px_rgba(0,0,0,0.7),inset_0_1px_0_rgba(255,255,255,0.05)] relative overflow-hidden">
            <div class="text-center space-y-6">
                <h1 class="gradient-gold text-5xl md:text-7xl font-bold tracking-wider uppercase">
                    DungeonXPlorer
                </h1>
                <div class="w-32 h-1 mx-auto bg-gradient-to-r from-transparent via-medieval-gold to-transparent"></div>
                <p class="text-xl md:text-2xl text-medieval-lightgold max-w-3xl mx-auto leading-relaxed">
                    Bienvenue dans DungeonXPlorer,<br>
                    <span class="text-medieval-cream">votre aventure médiévale fantaisie commence ici.</span>
                </p>
                <div class="flex flex-wrap justify-center gap-4 pt-8">
                    <a href="createAccount.php" class="px-8 py-4 bg-gradient-to-r from-medieval-gold/20 to-medieval-gold/30 border-2 border-medieval-gold/80 rounded-lg text-yellow-400 font-bold text-lg tracking-wide hover:from-medieval-gold/30 hover:to-medieval-gold/40 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(212,175,55,0.4)] transition-all duration-300">
                        Commencer l'Aventure
                    </a>
                    <a href="connection.php" class="px-8 py-4 bg-[rgba(42,30,20,0.5)] border-2 border-[rgba(139,105,20,0.3)] rounded-lg text-medieval-cream font-bold text-lg tracking-wide hover:bg-[rgba(139,105,20,0.3)] hover:border-medieval-gold/60 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(212,175,55,0.2)] transition-all duration-300">
                        Se Connecter
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-4xl md:text-5xl font-bold text-center mb-16 gradient-gold">
            Explorez un Monde Épique
        </h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,105,20,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-gold/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(212,175,55,0.3)] transition-all duration-300 overflow-hidden">
                <div class="text-5xl mb-6">⚔️</div>
                <h3 class="text-2xl font-bold text-medieval-gold mb-4">Donjons Mystérieux</h3>
                <p class="text-medieval-cream leading-relaxed">
                    Explorez des donjons remplis de trésors, de pièges mortels et de créatures légendaires. Chaque exploration est unique.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,105,20,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-gold/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(212,175,55,0.3)] transition-all duration-300 overflow-hidden">
                <div class="text-5xl mb-6">🛡️</div>
                <h3 class="text-2xl font-bold text-medieval-gold mb-4">Personnages Héroïques</h3>
                <p class="text-medieval-cream leading-relaxed">
                    Créez et personnalisez vos héros. Choisissez leur classe, leurs compétences et leur équipement pour affronter tous les défis.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card relative group bg-[rgba(42,30,20,0.5)] border border-[rgba(139,105,20,0.3)] rounded-xl p-8 hover:bg-[rgba(42,30,20,0.7)] hover:border-medieval-gold/50 hover:-translate-y-2 hover:shadow-[0_12px_30px_rgba(212,175,55,0.3)] transition-all duration-300 overflow-hidden">
                <div class="text-5xl mb-6">📜</div>
                <h3 class="text-2xl font-bold text-medieval-gold mb-4">Quêtes Épiques</h3>
                <p class="text-medieval-cream leading-relaxed">
                    Accomplissez des quêtes palpitantes, forgez votre légende et devenez le héros dont le royaume a besoin.
                </p>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="max-w-7xl mx-auto px-6 py-20 mb-20">
        <div class="bg-gradient-to-r from-medieval-brown/40 via-medieval-dark/60 to-medieval-brown/40 border border-medieval-gold/30 rounded-2xl p-12 text-center backdrop-blur-sm shadow-[0_8px_32px_rgba(0,0,0,0.7)]">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 text-medieval-lightgold">
                Prêt pour l'Aventure ?
            </h2>
            <p class="text-xl text-medieval-cream mb-8 max-w-2xl mx-auto">
                Rejoignez des milliers d'aventuriers et plongez dans un monde de magie, de mystères et de batailles épiques.
            </p>
            <a href="createAccount.php" class="inline-block px-10 py-5 bg-gradient-to-r from-medieval-gold/30 to-medieval-gold/40 border-2 border-medieval-gold text-yellow-300 font-bold text-xl tracking-wide rounded-lg hover:from-medieval-gold/40 hover:to-medieval-gold/50 hover:-translate-y-1 hover:shadow-[0_15px_40px_rgba(212,175,55,0.5)] transition-all duration-300">
                Créer Mon Compte Gratuitement
            </a>
        </div>
    </section>
    
    <?php include 'PHP/footer.php'; ?>
</body>
</html>