<?php
// app/views/entreprise/liste.php
?>
<form method="POST" action="/entreprise/rechercher">
    <input type="text" name="searchTerm" placeholder="Rechercher une entreprise">
    <button type="submit">Rechercher</button>
</form>

<table>
    <thead>
    <tr>
        <th>Nom</th>
        <th>Description</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($entreprises as $entreprise): ?>
        <tr>
            <td><?= $entreprise['NomE'] ?></td>
            <td><?= $entreprise['descr'] ?></td>
            <td><?= $entreprise['MailE'] ?></td>
            <td><?= $entreprise['TelE'] ?></td>
            <td>
                <a href="/entreprise/modifier/<?= $entreprise['IDE'] ?>">Modifier</a>
                <a href="/entreprise/supprimer/<?= $entreprise['IDE'] ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a href="/entreprise/ajouter">Ajouter une entreprise</a>
