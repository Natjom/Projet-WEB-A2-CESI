<?php
// Variables configurables
$company_name = "SuperStage"; // Mettez le nom souhaité ici
$current_year = date('Y');
$home_url = "index.php"; // URL de la page d'accueil
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
                <a href="<?= $home_url ?>" class="logo-link"><?= $company_name ?></a>
            </div>
            <p>Plateforme spécialisée dans la connexion entre étudiants et entreprises pour des stages pertinents.</p>
        </div>

        <!-- Section Navigation -->
        <div class="footer-section nav-section">
            <?php
            $nav_links = [
                'Accueil' => "$home_url",
                'Trouver un stage' => '/stages',
                'Employeurs' => '/employeurs',
                'Conseils pratiques' => '/blog',
                'Support' => '/contact'
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
        <p>© <?= $current_year ?> <?= $company_name ?> - Tous droits réservés</p>
        <nav class="footer-links">
            <ul>
                <?php foreach($legal_links as $url => $label): ?>
                    <li><a href="<?= $url ?>"><?= $label ?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>

</footer>