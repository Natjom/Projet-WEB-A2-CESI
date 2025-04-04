<?php
// app/views/dashboardAdmin.php

global $pdo;
session_start();
$isLoggedIn = isset($_SESSION['user']);

if ($_SESSION['role'] != 'Administrateur') {
    header("Location: /SuperStage/app/views/login.php");
    exit;
}

require_once(__DIR__ . "/../controllers/DashboardAdminController.php");
$controller = new DashboardController($pdo);
$utilisateurs = $controller->getUtilisateurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administrateur</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard.css">
</head>
<body>

<?php include __DIR__ . "/layout/header.php"; ?>

<main>
    <section class="page-content">
        <h1>Dashboard Administrateur</h1>

        <!-- Liste des utilisateurs -->
        <h2>Utilisateurs</h2>
        <a href="/SuperStage/app/controllers/addUtilisateur.php" class="cta-button">Ajouter un Utilisateur</a>
        <table>
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Adresse</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($utilisateurs as $utilisateur): ?>
                <tr>
                    <td><?php echo htmlspecialchars($utilisateur['NomU']); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['PrenomU']); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['MailU']); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['Role']); ?></td>
                    <td><?php echo htmlspecialchars($utilisateur['adresseA']) . ", " . htmlspecialchars($utilisateur['ville']); ?></td>
                    <td>
                        <a href="/SuperStage/app/views/editUtilisateur.php?id=<?php echo $utilisateur['IDu']; ?>">Modifier</a> |
                        <a href="/SuperStage/app/controllers/deleteUtilisateur.php?id=<?php echo $utilisateur['IDu']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
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
