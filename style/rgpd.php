<?php
session_start();
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'Anonyme';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>RGPD - SuperStage</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/responsive.css">
</head>
<body>
    <?php include __DIR__ . "/../../src/template/header.php"; ?>

    <main class="page-content">
        <h1>Politique de confidentialité (RGPD)</h1>
        <section>
            <h2>Collecte des données</h2>
            <p>
                Les données personnelles collectées incluent :<br>
                - Nom, prénom, email.<br>
                - Informations de profil (pour les utilisateurs connectés).<br>
                - Données de candidature (CV, lettre de motivation).
            </p>
        </section>

        <section>
            <h2>Finalité</h2>
            <p>
                Les données sont utilisées pour :<br>
                - Gérer les offres de stages.<br>
                - Assurer la sécurité du site.<br>
                - Envoyer des notifications aux utilisateurs.
            </p>
        </section>

        <section>
            <h2>Durée de conservation</h2>
            <p>
                Les données sont conservées pendant <?= $this->model->getRetentionPeriod() ?> ans conformément au RGPD.
            </p>
        </section>
    </main>

    <?php include __DIR__ . "/../../src/template/footer.php"; ?>
</body>
</html>
