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
    <link rel="icon" type="image/png" href="/icons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/icons/favicon.svg" />
    <link rel="shortcut icon" href="/icons/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="SuperStage" />
    <link rel="manifest" href="/icons/site.webmanifest" />

    <!-- Liens vers les fichiers CSS -->
    <link rel="stylesheet" href="/style/styles.css">
    <link rel="stylesheet" href="/style/navbar.css">

    <!-- Script JavaScript -->
    <script defer src="/script/script.js"></script>


</head>


<body>

<header>
    <nav class="navbar">
            <div class="logo"><a href="index.php">SuperStage</a></div>

        <!-- Navbar classique pour PC -->
        <ul class="nav-links">
            <li><a href="offres.php">Offres de stage</a></li>
            <li><a href="entreprises.php">Entreprises</a></li>
            <li class="login-wrapper">
                <a href="#" class="login-trigger">Connexion</a>
                <div id="login-panel" class="login-panel hidden">
                    <div class="login-container">
                        <span id="close-login">&times;</span>
                        <h2>Connexion</h2>
                        <form action="login.php" method="POST">
                            <label>
                                <input type="text" name="username" placeholder="Identifiant" required>
                            </label>
                            <label>
                                <input type="password" name="password" placeholder="Mot de passe" required>
                            </label>
                            <button type="submit">Se connecter</button>
                        </form>
                        <div class="login-links">
                            <a href="forgot-password.php">Mot de passe oublié ?</a>
                            <a href="register.php">Inscription</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="settings-wrapper">
                <a href="#" class="settings-trigger">
                    <img src="/icons/param.png" alt="Paramètres" class="settings-icon">
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
                            <button type="button">Sauvegarder</button>
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
            <li><a href="offres.php">Offres de stage</a></li>
            <li><a href="entreprises.php">Entreprises</a></li>
            <li><a href="#" class="login-trigger">Connexion</a></li>
        </ul>
    </div>
</header>

