<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .medieval-navbar {
            background: linear-gradient(to bottom, #2c1810, #1a0f08);
            border-bottom: 4px solid #8b6914;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            font-family: 'Georgia', serif;
        }

        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .navbar-logo {
            font-size: 28px;
            font-weight: bold;
            color: #d4af37;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            letter-spacing: 2px;
        }

        .navbar-menu {
            display: flex;
            list-style: none;
            gap: 5px;
        }

        .navbar-menu li a {
            display: block;
            padding: 12px 20px;
            color: #e8d4b0;
            text-decoration: none;
            background: linear-gradient(to bottom, #4a2c1a, #3a1c0a);
            border: 2px solid #8b6914;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-size: 16px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        }

        .navbar-menu li a:hover {
            background: linear-gradient(to bottom, #6b3d1f, #5a2d1a);
            color: #ffd700;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(212, 175, 55, 0.3);
        }

        .navbar-menu li a.active {
            background: linear-gradient(to bottom, #8b6914, #6b5010);
            color: #ffd700;
            border-color: #d4af37;
        }
    </style>
</head>
<body>
    <nav class="medieval-navbar">
        <div class="navbar-container">
            <div class="navbar-logo">⚔️ DungeonXPlorer</div>
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