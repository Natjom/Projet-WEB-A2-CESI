<?php
global $pdo;
session_start();
include __DIR__ . "/layout/header.php";
require_once(__DIR__ . "/../../config/config.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: /SuperStage/login.php");
    exit();
}

// Récupérer les données de l'utilisateur
$userId = $_SESSION['id'];
$query = "SELECT * FROM Users WHERE IDu = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":id", $userId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Si l'utilisateur n'existe pas dans la base de données
    echo "Utilisateur introuvable.";
    exit();
}

?>

<head>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>

<main>
    <section class="page-content">
        <h1>Mon Compte</h1>

        <h2>Informations personnelles</h2>
        <form id="update-form">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['NomU']) ?>" required>
            <label for="surname">Prénom</label>
            <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($user['PrenomU']) ?>" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['MailU']) ?>" required>
            <label for="birthdate">Date de naissance</label>
            <input type="date" id="birthdate" name="birthdate" value="<?= $user['Date_NaisU'] ?>" required>
            <button type="submit">Mettre à jour</button>
        </form> <br /><br />

        <h2>Changer le mot de passe</h2>
        <form id="password-form">
            <label for="current-password">Mot de passe actuel</label>
            <input type="password" id="current-password" name="current-password" required>
            <label for="new-password">Nouveau mot de passe</label>
            <input type="password" id="new-password" name="new-password" required>
            <label for="confirm-password">Confirmer le mot de passe</label>
            <input type="password" id="confirm-password" name="confirm-password" required>
            <button type="submit">Changer le mot de passe</button>
        </form> <br /><br />

        <?php if ($user['Role'] === 'Etudiant'): ?>
            <h2>Mes candidatures</h2>
            <?php
            // Récupérer les candidatures de l'étudiant
            $query = "SELECT Offre.Poste, Offre.Date_debutO, Offre.Date_finO, Candidature.Date_candidature
                      FROM Candidature
                      JOIN Offre ON Candidature.IDoffre = Offre.IDoffre
                      WHERE Candidature.IDu = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":id", $userId);
            $stmt->execute();
            $candidatures = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($candidatures): ?>
                <table>
                    <thead>
                    <tr>
                        <th>Poste</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Date de candidature</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($candidatures as $candidature): ?>
                        <tr>
                            <td><?= htmlspecialchars($candidature['Poste']) ?></td>
                            <td><?= htmlspecialchars($candidature['Date_debutO']) ?></td>
                            <td><?= htmlspecialchars($candidature['Date_finO']) ?></td>
                            <td><?= htmlspecialchars($candidature['Date_candidature']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucune candidature en cours.</p>
            <?php endif; ?>
        <?php endif; ?>

        <br /><br />

        <h2>
            <form action="/app/controllers/Logout.php" method="POST">
                <button type="submit" id="logout-button">Se déconnecter</button>
            </form>
        </h2>
    </section>
</main>

<?php include __DIR__ . "/layout/footer.php"; ?>
