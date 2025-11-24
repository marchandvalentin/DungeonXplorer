<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Cormorant+Garamond:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .medieval-navbar {
            background: linear-gradient(135deg, #1a1614 0%, #2d2520 50%, #1a1614 100%);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.7), inset 0 1px 0 rgba(255, 255, 255, 0.05);
            font-family: 'Cinzel', serif;
            position: relative;
        }

        .medieval-navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
            opacity: 0.5;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s ease;
        }

        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .navbar-brand img {
            height: 50px;
            filter: drop-shadow(0 4px 8px rgba(212, 175, 55, 0.4));
            transition: filter 0.3s ease;
        }

        .navbar-brand:hover img {
            filter: drop-shadow(0 6px 12px rgba(212, 175, 55, 0.6));
        }

        .navbar-logo {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #d4af37 0%, #f4e5c3 50%, #d4af37 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 3px;
            text-transform: uppercase;
            position: relative;
        }

        .navbar-logo::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
            opacity: 0.5;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            gap: 8px;
        }

        .navbar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #e8d4b0;
            text-decoration: none;
            background: rgba(42, 30, 20, 0.5);
            border: 1px solid rgba(139, 105, 20, 0.3);
            border-radius: 8px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
        }

        .navbar-menu li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .navbar-menu li a:hover::before {
            left: 100%;
        }

        .navbar-menu li a:hover {
            background: rgba(139, 105, 20, 0.3);
            color: #ffd700;
            transform: translateY(-3px);
            border-color: rgba(212, 175, 55, 0.6);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3),
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .navbar-menu li a.active {
            background: linear-gradient(135deg, rgba(139, 105, 20, 0.4), rgba(107, 80, 16, 0.4));
            color: #ffd700;
            border-color: rgba(212, 175, 55, 0.8);
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4),
                        inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .navbar-menu li a.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
        }

        @media (max-width: 768px) {
            .navbar-container {
                flex-direction: column;
                gap: 20px;
                padding: 15px 20px;
            }

            .navbar-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .navbar-menu li a {
                padding: 10px 16px;
                font-size: 14px;
            }

            .navbar-logo {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <nav class="medieval-navbar">
        <div class="navbar-container">
            <div class="navbar-brand">
                <img src="./res/logo/Logo.png" alt="Logo">
                <div class="navbar-logo">DungeonXPlorer</div>
            </div>
            <ul class="navbar-menu">
                <li><a href="index.php" class="active">Accueil</a></li>
                <li><a href="dungeon.php">Donjon</a></li>
                <li><a href="character.php">Personnages</a></li>
                <li><a href="inventory.php">Inventaire</a></li>
                <li><a href="quests.php">Quêtes</a></li>
                <li><a href="profile.php">Profil</a></li>
            </ul>
        </div>
    </nav>