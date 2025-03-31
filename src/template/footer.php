<?php
// Variables configurables
$company_name = "SuperStage";
$current_year = date('Y');
$home_url = "index.php";
$logo_path = "icons/favicon-96x96.png"; // Mettez le chemin de votre logo ici (ex: "images/logo.png")
$legal_links = [
    '/mentions-legales' => 'Mentions légales',
    '/politique-confidentialite' => 'Politique de confidentialité'
];
?>
<style>
    <?php include 'style/footer-style.css'; ?>
</style>
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
                'Trouver un stage' => "offres.php",
                'Entreprises' => "entreprises.php",
                'Support' => "help.php",
            ];

            foreach($nav_links as $label => $url):
                ?>
                <a href="<?= $url ?>"><?= $label ?></a>
            <?php endforeach; ?>
        </div>

        <!-- Section Authentification -->
        <div class="footer-section auth-section">
            <a href="/inscription" class="auth-button">Inscription</a>
            <a href="/connexion" class="auth-button">Se connecter</a>
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