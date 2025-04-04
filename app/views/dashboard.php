<?php
// app/views/dashboard.php

global $pdo;
session_start();
$isLoggedIn = isset($_SESSION['user']);

if ($_SESSION['role'] != 'Pilote') {
    header("Location: /SuperStage/app/views/login.php");
    exit;
}

require_once(__DIR__ . "/../controllers/DashboardController.php");
$controller = new DashboardController($pdo);
$entreprises = $controller->getEntreprises();
$offres = $controller->getOffres();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Pilote</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
</head>
<body>

<?php include __DIR__ . "/layout/header.php"; ?>

<main>
    <section class="page-content">
        <h1>Dashboard</h1>

        <h2>Entreprises</h2>
        <table>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Moyenne</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Secteur</th>
                <th>Adresse</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($entreprises as $entreprise): ?>
                <tr>
                    <td><?php echo htmlspecialchars($entreprise['NomE']); ?></td>
                    <td><?php echo htmlspecialchars($entreprise['descr']); ?></td>
                    <td><?php echo htmlspecialchars($entreprise['Moyenne']); ?></td>
                    <td><?php echo htmlspecialchars($entreprise['MailE']); ?></td>
                    <td><?php echo htmlspecialchars($entreprise['TelE']); ?></td>
                    <td><?php echo htmlspecialchars($entreprise['Secteur_Act']); ?></td>
                    <td><?php echo htmlspecialchars($entreprise['adresseA']) . ", " . htmlspecialchars($entreprise['ville']); ?></td>
                    <td>
                        <a href="/SuperStage/app/views/editEntreprise.php?id=<?php echo $entreprise['IDE']; ?>">Modifier</a> |
                        <a href="/SuperStage/app/controllers/deleteEntreprise.php?id=<?php echo $entreprise['IDE']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Offres de Stage</h2>
        <table>
            <thead>
            <tr>
                <th>Poste</th>
                <th>Rémunération</th>
                <th>Dates</th>
                <th>Entreprise</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($offres as $offre): ?>
                <tr>
                    <td><?php echo htmlspecialchars($offre['Poste']); ?></td>
                    <td><?php echo htmlspecialchars($offre['remune']); ?></td>
                    <td><?php echo htmlspecialchars($offre['Date_debutO']) . " - " . htmlspecialchars($offre['Date_finO']); ?></td>
                    <td><?php echo htmlspecialchars($offre['NomE']); ?></td>
                    <td>
                        <a href="/SuperStage/app/views/editOffre.php?id=<?php echo $offre['IDoffre']; ?>">Modifier</a> |
                        <a href="/SuperStage/app/controllers/deleteOffre.php?id=<?php echo $offre['IDoffre']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre de stage ?')">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<?php include __DIR__ . "/layout/footer.php"; ?>

</body>
</html>
