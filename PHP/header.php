<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/CSS/personaliseColors.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <script src="/JS/script.js" defer></script>
</head>
<body class="flex flex-col min-h-screen">

    <nav class="navbar-gradient navbar-top-line relative border-b border-medieval-red/30 shadow-[0_8px_32px_rgba(0,0,0,0.7),inset_0_1px_0_rgba(255,255,255,0.05)] backdrop-blur-md font-inter">
        <div class="max-w-7xl mx-auto px-10 py-5 flex flex-col md:flex-row justify-between items-center gap-5">

            <div class="flex ml-0 items-center gap-4 transition-transform duration-300 hover:scale-105 cursor-pointer">
                <img src="/res/logo/Logo.png" alt="Logo" class="h-12 drop-shadow-[0_4px_8px_rgba(198,40,40,0.4)] hover:drop-shadow-[0_6px_12px_rgba(198,40,40,0.6)] transition-all duration-300">
                <div class="gradient-red relative text-3xl md:text-4xl font-bold tracking-[0.15em] uppercase">
                    <a href="/">
                        DungeonXPlorer
                    </a>
                </div>
            </div>
            
            <ul class="flex flex-wrap justify-center gap-2 list-none">
                <?php 
                    $isloggedIn = isset($_SESSION['user_id']);
                    $isAdmin = false;
                    
                    if ($isloggedIn) {
                        // Check if user is admin by querying the database
                        require_once __DIR__ . '/BDD/bdd_functions.php';
                        $user = getUserByEmail($_SESSION['user_email'] ?? '');
                        $isAdmin = ($user && isset($user['IS_ADMIN']) && $user['IS_ADMIN']);
                    }
                    
                    if ($isloggedIn): 
                ?>
                    <li class="px-6 py-3 text-white text-3l font-semibold tracking-wide text-sm rounded-lg">
                        <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                    </li>

                    <?php if ($isAdmin): ?>
                        <li>
                            <a href="/dashboard" class="nav-link nav-link-active relative flex items-center px-6 py-3 text-white font-semibold tracking-wide text-sm rounded-lg bg-[rgba(139,40,40,0.4)] border border-medieval-red/80 shadow-[0_4px_15px_rgba(198,40,40,0.4),inset_0_1px_0_rgba(255,255,255,0.15)] backdrop-blur-sm overflow-hidden transition-all duration-300 hover:-translate-y-1 
                                hover:shadow-[0_8px_20px_rgba(198,40,40,0.3),inset_0_1px_0_rgba(255,255,255,0.1)]">
                                Tableau de bord
                            </a>
                        </li>
                        <?php else: ?>
                        <li>
                            <a href="/heros" class="nav-link nav-link-active relative flex items-center px-6 py-3 text-white font-semibold tracking-wide text-sm rounded-lg bg-[rgba(139,40,40,0.4)] border border-medieval-red/80 shadow-[0_4px_15px_rgba(198,40,40,0.4),inset_0_1px_0_rgba(255,255,255,0.15)] backdrop-blur-sm overflow-hidden transition-all duration-300 hover:-translate-y-1 
                                hover:shadow-[0_8px_20px_rgba(198,40,40,0.3),inset_0_1px_0_rgba(255,255,255,0.1)]">
                                Mes Heros
                            </a>
                        </li> 

                    <?php endif; ?>

                    <li>
                        <a href="/logout" class="nav-link relative flex items-center px-6 py-3 text-white font-semibold tracking-wide text-sm rounded-lg bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] backdrop-blur-sm overflow-hidden transition-all duration-300 hover:bg-[rgba(139,40,40,0.3)]  hover:-translate-y-1 hover:border-medieval-red/60 
                        hover:shadow-[0_8px_20px_rgba(198,40,40,0.3),inset_0_1px_0_rgba(255,255,255,0.1)]">
                            Déconnexion
                        </a>
                    </li>
                <?php else: ?>
                <li>
                    <a href="/register" class="nav-link nav-link-active relative flex items-center px-6 py-3 text-white font-semibold tracking-wide text-sm rounded-lg bg-[rgba(139,40,40,0.4)] border border-medieval-red/80 shadow-[0_4px_15px_rgba(198,40,40,0.4),inset_0_1px_0_rgba(255,255,255,0.15)] backdrop-blur-sm overflow-hidden transition-all duration-300 hover:-translate-y-1 
                        hover:shadow-[0_8px_20px_rgba(198,40,40,0.3),inset_0_1px_0_rgba(255,255,255,0.1)]">
                        Créer un compte
                    </a>
                </li>
                <li>
                    <a href="/login" class="nav-link relative flex items-center px-6 py-3 text-white font-semibold tracking-wide text-sm rounded-lg bg-[rgba(42,30,20,0.5)] border border-[rgba(139,40,40,0.3)] backdrop-blur-sm overflow-hidden transition-all duration-300 hover:bg-[rgba(139,40,40,0.3)]  hover:-translate-y-1 hover:border-medieval-red/60 
                    hover:shadow-[0_8px_20px_rgba(198,40,40,0.3),inset_0_1px_0_rgba(255,255,255,0.1)]">
                        Se connecter
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>