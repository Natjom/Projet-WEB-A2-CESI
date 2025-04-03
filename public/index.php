<head>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/footer.css">
</head>
<?php include __DIR__ . "/../app/views/layout/header.php"; ?>

<main>
    <section class="hero">
        <h1>SuperStage</h1>
        <p>La plateforme qui connecte étudiants et entreprises.</p>
        <a href="/app/views/offres.php" class="cta-button">Voir les offres</a>
    </section>

    <!-- Section Présentation -->
    <section class="about">
        <h2>Pourquoi choisir SuperStage ?</h2>
        <div class="features">
            <div class="feature">
                <h3>🎯 Offres ciblées</h3>
                <p>Trouvez un stage adapté à votre profil en quelques clics.</p>
            </div>
            <div class="feature">
                <h3>🔍 Recherche facile</h3>
                <p>Un moteur de recherche puissant pour vous aider à filtrer les offres.</p>
            </div>
            <div class="feature">
                <h3>🤝 Mise en relation rapide</h3>
                <p>Postulez et échangez directement avec les recruteurs.</p>
            </div>
        </div>
    </section>
</main>

<?php include __DIR__ . "/../app/views/layout/footer.php"; ?>
