<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>RGPD - SuperStage</title>
    <link rel="stylesheet" href="/public/assets/css/legal.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>
    <?php include __DIR__ . "/layout/header.php"; ?>

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

    <?php include __DIR__ . "/layout/footer.php"; ?>
</body>
</html>
