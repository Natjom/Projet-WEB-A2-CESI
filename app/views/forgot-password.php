<head>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>

<?php include __DIR__ . "/layout/header.php"; ?>

<main>
    <section class="page-content">
        <h1>Mot de passe oublié</h1>

        <p>Veuillez entrer votre adresse e-mail pour recevoir un lien de réinitialisation.</p>

        <form action="#" method="POST" id="forgot-password-form">
            <label for="email">Adresse e-mail</label>
            <input type="email" name="email" id="email" placeholder="votre@email.com" required>

            <button type="submit">Envoyer le lien de réinitialisation</button>
        </form>
    </section>
</main>

<?php include __DIR__ . "/layout/footer.php"; ?>
