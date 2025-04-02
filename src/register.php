<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/style/styles.css">
    <link rel="stylesheet" href="/style/navbar.css">
    <link rel="stylesheet" href="/style/footer.css">
</head>
<body>

<?php include __DIR__ . "/template/header.php"; ?>

<main class="register-container">
    <h1>Inscription</h1>
    <form id="register-form">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
    <p id="register-error" style="color: red;"></p>
    <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a></p>
</main>

<?php include __DIR__ . "/template/footer.php"; ?>

<script src="/scripts/register.js"></script>

</body>
</html>
