<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="CSS/personaliseColors.css">

    <title>DungeonXPlorer - Inscription</title>
</head>
<body class="text-medieval-cream" style="background: linear-gradient(135deg, #0d0b0a 0%, #1a1614 50%, #0d0b0a 100%);">
    <?php include 'PHP/header.php'; ?>
 
    <!-- Registration Form Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="max-w-md mx-auto hero-card rounded-2xl p-8 border border-medieval-red/30 shadow-[0_8px_32px_rgba(0,0,0,0.7),inset_0_1px_0_rgba(255,255,255,0.05)] relative overflow-hidden" style="background: linear-gradient(135deg, rgba(42, 30, 20, 0.6), rgba(26, 22, 20, 0.8));">
            <div class="text-center space-y-8">
                <h1 class="gradient-red text-4xl font-bold tracking-wider uppercase">
                    S'Inscrire
                </h1>
                <div class="w-24 h-1 mx-auto bg-gradient-to-r from-transparent via-medieval-red to-transparent"></div>
                
                <form method="POST" action="/register" class="space-y-6">
                    <!-- Nom -->
                    <div>
                        <label for="nom" class="block text-sm font-semibold mb-2 text-medieval-lightred">Nom</label>
                        <input 
                            type="text" 
                            id="nom" 
                            name="nom" 
                            placeholder="Entrez votre nom"
                            required
                            class="form-input w-full px-4 py-3 rounded-lg transition-all duration-300 font-inter"
                        >
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold mb-2 text-medieval-lightred">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Entrez votre email"
                            required
                            class="form-input w-full px-4 py-3 rounded-lg transition-all duration-300 font-inter"
                        >
                    </div>
                    
                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-semibold mb-2 text-medieval-lightred">Mot de passe</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Entrez votre mot de passe"
                            required
                            class="form-input w-full px-4 py-3 rounded-lg transition-all duration-300 font-inter"
                        >
                    </div>
                    
                    <!-- Confirmer Mot de passe -->
                    <div>
                        <label for="password_confirm" class="block text-sm font-semibold mb-2 text-medieval-lightred">Confirmer mot de passe</label>
                        <input 
                            type="password" 
                            id="password_confirm" 
                            name="password_confirm" 
                            placeholder="Confirmez votre mot de passe"
                            required
                            class="form-input w-full px-4 py-3 rounded-lg transition-all duration-300 font-inter"
                        >
                    </div>
                    
                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full px-6 py-3 mt-4 bg-gradient-to-r from-medieval-red/20 to-medieval-red/30 border-2 border-medieval-red/80 rounded-lg text-red-400 font-bold text-lg tracking-wide hover:from-medieval-red/30 hover:to-medieval-red/40 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(198,40,40,0.4)] transition-all duration-300"
                    >
                        S'Inscrire
                    </button>
                </form>
                
                <p class="text-medieval-cream/70 text-sm">
                    Déjà inscrit ? 
                    <a href="/login" class="text-medieval-lightred font-semibold hover:text-red-400 transition-colors">
                        Se connecter
                    </a>
                </p>
            </div>
        </div>
    </section>

    <?php include 'PHP/footer.php'; ?>
</body>
</html>