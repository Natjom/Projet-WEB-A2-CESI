<?php include 'auth.php'; ?>

<form method="POST" action="">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <input type="date" name="date_naissance" required>
    <input type="text" name="id_adresse" placeholder="ID Adresse" required>
    <button type="submit" name="register">S'inscrire</button>
</form>
