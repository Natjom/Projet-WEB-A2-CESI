<?php
// Variables configurables
$company_name = "SuperStage";
$current_year = date('Y');
$home_url = "/SuperStage/public/index.php";
$logo_path = "/icons/favicon-96x96.png"; // Mettez le chemin de votre logo ici (ex: "images/logo.png")
$legal_links = [
    '/SuperStage/app/views/mentions-legales.php' => 'Mentions légales',
    '/SuperStage/app/views/rgpd.php' => 'Politique de confidentialité'
];
?>
<footer class="custom-footer">
    <div class="footer-content">
        <!-- Section À propos -->
        <div class="footer-section about-section">
            <div class="logo">
                <a href="<?= $home_url ?>" class="logo-link">
                    <img src="<?= $logo_path ?>" alt="<?= $company_name ?>">
                </a>
            </div>
            <p>Plateforme spécialisée dans la connexion entre étudiants et entreprises pour des stages pertinents.</p>
        </div>

        <!-- Section Navigation -->
        <div class="footer-section nav-section">
            <?php
            $nav_links = [
                'Accueil' => "$home_url",
                'Trouver un stage' => "/SuperStage/app/views/offres.php",
                'Entreprises' => "/SuperStage/app/views/entreprises.php",
                'Support' => "help.php",
            ];

            foreach($nav_links as $label => $url):
                ?>
                <a href="<?= $url ?>"><?= $label ?></a>
            <?php endforeach; ?>
        </div>

        <!-- Section Authentification -->
        <div class="footer-section auth-section">
            <a href="/SuperStage/app/views/register.php" class="auth-button">Inscription</a>
            <a href="login.php" class="auth-button">Se connecter</a>
        </div>
    </div>

    <!-- Section Mentions légales -->
    <div class="footer-container">
        <div class="legal-line">
            <span class="copyright">© <?= $current_year ?> <?= $company_name ?> - Tous droits réservés</span>
            <nav class="footer-links">
                <ul>
                    <?php foreach($legal_links as $url => $label): ?>
                        <li><a href="<?= $url ?>"><?= $label ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </div>

</footer>