<?php
// app/views/entreprise/modifier.php
?>
<form method="POST">
    <label for="nom">Nom</label><input type="text" name="nom" value="<?= $entreprise['NomE'] ?>" required>
    <label for="descr">Description</label><textarea name="descr" required><?= $entreprise['descr'] ?></textarea>
    <label for="email">Email</label><input type="email" name="email" value="<?= $entreprise['MailE'] ?>" required>
    <label for="tel">Téléphone</label><input type="tel" name="tel" value="<?= $entreprise['TelE'] ?>" required>
    <label for="secteur">Secteur</label><input type="text" name="secteur" value="<?= $entreprise['IdSec'] ?>" required>
    <label for="adresse">Adresse</label><input type="text" name="adresse" value="<?= $entreprise['ID_adresse'] ?>" required>
    <button type="submit">Modifier</button>
</form>
