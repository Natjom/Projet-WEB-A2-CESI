<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StageConnect</title>
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="style/navbar.css">
    <script defer src="script/script.js"></script>

    <link rel="icon" type="image/png" href="/icons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/icons/favicon.svg" />
    <link rel="shortcut icon" href="/icons/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/icons/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="SuperStage" />
    <link rel="manifest" href="/icons/site.webmanifest" />


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
                            <input type="text" name="username" placeholder="Identifiant" required>
                            <input type="password" name="password" placeholder="Mot de passe" required>
                            <button type="submit">Se connecter</button>
                        </form>
                        <div class="login-links">
                            <a href="forgot-password.php">Mot de passe oublié ?</a>
                            <a href="register.php">Inscription</a>
                        </div>
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

