<?php
// app/views/entreprise/ajouter.php
?>
<form method="POST">
    <label for="nom">Nom</label><input type="text" name="nom" required>
    <label for="descr">Description</label><textarea name="descr" required></textarea>
    <label for="email">Email</label><input type="email" name="email" required>
    <label for="tel">Téléphone</label><input type="tel" name="tel" required>
    <label for="secteur">Secteur</label><input type="text" name="secteur" required>
    <label for="adresse">Adresse</label><input type="text" name="adresse" required>
    <button type="submit">Ajouter</button>
</form>
