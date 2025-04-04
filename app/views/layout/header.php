<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperStage - Trouvez Votre Stage Idéal</title>

    <!-- Meta description pour le SEO -->
    <meta name="description" content="SuperStage est la plateforme idéale pour trouver un stage. Découvrez des opportunités dans divers secteurs et accédez à des offres adaptées à vos compétences et à vos ambitions professionnelles.">

    <!-- Open Graph pour les réseaux sociaux -->
    <meta property="og:title" content="SuperStage - Trouvez Votre Stage Idéal">
    <meta property="og:description" content="SuperStage vous aide à trouver le stage qui vous correspond. Explorez des opportunités dans tous les domaines professionnels.">
    <meta property="og:image" content="/icons/favicon-96x96.png">
    <meta property="og:url" content="https://www.superstage.fr">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SuperStage - Trouvez Votre Stage Idéal">
    <meta name="twitter:description" content="SuperStage vous aide à trouver le stage qui vous correspond. Explorez des opportunités dans tous les domaines professionnels.">
    <meta name="twitter:image" content="/icons/favicon-96x96.png">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/public/assets/img/icons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/public/assets/img/icons/favicon.svg" />
    <link rel="shortcut icon" href="/public/assets/img/icons/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/public/assets/img/icons/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="SuperStage" />
<!--    <link rel="manifest" href="/icons/site.webmanifest" />-->

    <!-- Script JavaScript -->
    <script defer src="/public/assets/js/login-panel.js"></script>
    <script defer src="/public/assets/js/settings.js"></script>

</head>


<body>

<header>
    <nav class="navbar">
        <div class="logo"><a href="/SuperStage/public/index.php">SuperStage</a></div>
        <!-- Navbar classique pour PC -->
        <ul class="nav-links">
            <li><a href="/SuperStage/app/views/offres.php">Offres de stage</a></li>
            <li><a href="/SuperStage/app/views/entreprises.php">Entreprises</a></li>

            <?php
            session_start();
            $isLoggedIn = isset($_SESSION['user']);
            ?>

            <?php if ($_SESSION['role'] == 'Pilote'): ?>
                <li><a href="/SuperStage/app/views/dashboard.php">Dashboard</a></li>
            <?php elseif ($_SESSION['role'] == 'Administrateur'): ?>
                <li><a href="/SuperStage/app/views/administration.php">Administration</a></li>
            <?php endif; ?>

            <li class="login-wrapper" <?= $isLoggedIn ? 'style="display: none;"' : '' ?>>
                <a href="#" class="login-trigger">Connexion</a>
                <div id="login-panel" class="login-panel hidden">
                    <div class="login-container">
                        <span id="close-login">&times;</span>
                        <h2>Connexion</h2>
                        <form id="login-form" method="POST" action="/app/controllers/AuthController.php">
                            <label>
                                <input type="text" name="email" placeholder="Identifiant" required>
                            </label>
                            <label>
                                <input type="password" name="password" placeholder="Mot de passe" required>
                            </label>
                            <button type="submit">Se connecter</button>
                            <p id="login-error" style="color: red;"></p>
                        </form>
                        <div class="login-links">
                            <a href="/SuperStage/app/views/forgot-password.php">Mot de passe oublié ?</a>
                            <a href="/SuperStage/app/views/register.php">Inscription</a>
                        </div>
                    </div>
                </div>
            </li>

            <li class="logout-wrapper" <?= !$isLoggedIn ? 'style="display: none;"' : '' ?>>
                <a href="/SuperStage/app/views/compte.php" class="logout-btn"><?= $_SESSION['user']['NomU'] ?? 'Utilisateur' ?></a>
                <div id="profile-menu" class="hidden">
                    <ul>
                        <li><a href="/SuperStage/app/views/compte.php">Compte</a></li>
                        <li><button id="logout-button">Déconnexion</button></li>
                    </ul>
                </div>
            </li>

            <li class="settings-wrapper">
                <a href="#" class="settings-trigger">
                    <img src="/public/assets/img/icons/param.png" alt="Paramètres" class="settings-icon">
                </a>
                <div id="settings-panel" class="settings-panel hidden">
                    <div class="settings-container">
                        <span id="close-settings">&times;</span>
                        <h2>Paramètres</h2>
                        <form>
                            <label for="theme">Thème :</label>
                            <select id="theme">
                                <option value="light">Clair</option>
                                <option value="dark">Sombre</option>
                            </select>
                            <label for="role">Rôle (temporaire) :</label>
                            <select id="role">
                                <option value="Administrateur">Administrateur</option>
                                <option value="Pilote">Pilote</option>
                                <option value="Etudiant">Etudiant</option>
                            </select>
                            <button type="button" id="save-settings">Sauvegarder</button>
                        </form>
                    </div>
                </div>
            </li>

        </ul>
        <!-- Menu burger pour mobile -->
        <div class="burger" aria-label="Menu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </nav>

    <!-- Menu déroulant -->
    <div class="menu">
        <ul>
            <li><a href="/app/views/offres.php">Offres de stage</a></li>
            <li><a href="/app/views/entreprises.php">Entreprises</a></li>
            <li><a href="#" class="login-trigger">Connexion</a></li>
            <?php if ($isLoggedIn): ?>
                <?php if ($_SESSION['role'] == 'Pilote'): ?>
                    <li><a href="/SuperStage/app/views/dashboard.php">Dashboard</a></li>
                <?php elseif ($_SESSION['role'] == 'Administrateur'): ?>
                    <li><a href="/SuperStage/app/views/administration.php">Administration</a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
    </div>
</header>


