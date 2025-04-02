
<head>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>

<?php include __DIR__ . "/layout/header.php";


require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../app/models/EntrepriseModel.php';
require_once __DIR__ . '/../../app/controllers/EntrepriseController.php';
global $pdo;
$controller = new EntrepriseController(new EntrepriseModel($pdo));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'ajouter':
            $controller->ajouter();
            break;
        case 'modifier':
            $controller->modifier($_POST['id']);
            break;
        case 'supprimer':
            $controller->supprimer($_POST['id']);
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Entreprises</title>
</head>
<body>
<h1>Gestion des Entreprises</h1>

<!-- Formulaire de recherche -->
<form action="entreprises.php" method="GET">
    <input type="text" name="recherche" placeholder="Rechercher une entreprise">
    <button type="submit">Rechercher</button>
</form>

<!-- Liste des entreprises -->
<table border="1">
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
    <?php
    $entreprises = $controller->liste(); // Récupère toutes les entreprises
    foreach ($entreprises as $entreprise) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($entreprise['NomE']) . '</td>';
        echo '<td>' . htmlspecialchars($entreprise['descr']) . '</td>';
        echo '<td>' . htmlspecialchars($entreprise['MailE']) . '</td>';
        echo '<td>' . htmlspecialchars($entreprise['TelE']) . '</td>';
        echo '<td>
                    <a href="entreprises.php?action=modifier&id=' . $entreprise['IDE'] . '">Modifier</a>
                    <form action="entreprises.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="supprimer">
                        <input type="hidden" name="id" value="' . $entreprise['IDE'] . '">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>

<!-- Formulaire d'ajout -->
<h2>Ajouter une nouvelle entreprise</h2>
<form action="entreprises.php" method="POST">
    <input type="hidden" name="action" value="ajouter">
    <label for="nom">Nom:</label>

<?php include __DIR__ . "/layout/footer.php"; ?>