<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réseau Social Universitaire</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-layout">
        <!-- Sidebar Gauche -->
        <aside class="nav-sidebar">
            <div class="logo-area">🎓 UniSocial</div>
            
            <nav class="menu-group">
                <span class="menu-label">Menu Principal</span>
                <a href="index.php" class="menu-item <?= (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : '' ?>">
                    📰 Accueil
                </a>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="edit_profile.php" class="menu-item <?= (basename($_SERVER['PHP_SELF']) == 'edit_profile.php') ? 'active' : '' ?>">
                        👤 Mon Profil
                    </a>
                    <a href="logout.php" class="menu-item">
                        🚪 Déconnexion
                    </a>
                <?php else: ?>
                    <a href="login.php" class="menu-item <?= (basename($_SERVER['PHP_SELF']) == 'login.php') ? 'active' : '' ?>">
                        🔓 Connexion
                    </a>
                    <a href="register.php" class="menu-item <?= (basename($_SERVER['PHP_SELF']) == 'register.php') ? 'active' : '' ?>">
                        ✍️ Inscription
                    </a>
                <?php endif; ?>
            </nav>
        </aside>
        
        <!-- Centre : Contenu Principal -->
        <main class="feed-area">
            <div class="feed-content">