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
    <title>Cookies - SuperStage</title>
    <link rel="stylesheet" href="/styles.css">
    <link rel="stylesheet" href="/responsive.css">
</head>
<body>
    <?php include __DIR__ . "/../../src/template/header.php"; ?>

    <main class="page-content">
        <h1>Politique des cookies</h1>
        <section>
            <h2>Utilisation des cookies</h2>
            <p>
                Notre site utilise deux types de cookies :<br>
                - **Cookies techniques** (obligatoires pour le fonctionnement du site).<br>
                - **Cookies analytiques** (optionnels, pour suivre le trafic).
            </p>
        </section>

        <section>
            <h2>Suppression des cookies</h2>
            <p>
                Pour supprimer les cookies existants, utilisez les options de votre navigateur.
            </p>
        </section>
    </main>

    <?php include __DIR__ . "/../..//src/template/footer.php"; ?>
</body>
</html>
