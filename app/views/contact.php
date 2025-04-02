<head>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<?php include __DIR__ . "/template/header.php"; ?>

<main>
    <section class="page-content">
        <h1>Contact</h1>
        <p>Besoin d'aide ? Contactez-nous via le formulaire ci-dessous.</p>
        <form class="contact-form">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message :</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Envoyer</button>
        </form>
    </section>
</main>

<?php include __DIR__ . "/SuperStage/src/template/footer.php"; ?>
