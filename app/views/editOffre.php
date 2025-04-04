<?php
global $pdo;
session_start();
require_once(__DIR__ . "/../../config/config.php");

// Vérification de l'accès : l'utilisateur doit être connecté et avoir le rôle "Pilote"
if ($_SESSION['role'] != 'Pilote') {
    header("Location: /SuperStage/app/views/login.php");
    exit;
}

// Vérification de l'ID de l'offre
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Si l'ID n'est pas passé ou est invalide, on redirige vers le dashboard
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
}

// Récupération de l'ID de l'offre à éditer
$offreId = $_GET['id'];

// Préparation de la requête pour récupérer les informations de l'offre
$query = "SELECT o.*, e.NomE, e.MailE, e.TelE, e.Site, e.IdSec
          FROM Offre o
          INNER JOIN Entreprise e ON o.IDE = e.IDE
          WHERE o.IDoffre = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $offreId, PDO::PARAM_INT);
$stmt->execute();

// Récupération des données de l'offre
$offre = $stmt->fetch(PDO::FETCH_ASSOC);

// Si l'offre n'existe pas, redirection vers le dashboard
if (!$offre) {
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
}

// Récupération des secteurs d'activité pour le formulaire
$querySecteur = "SELECT * FROM Secteur_activite";
$stmtSecteur = $pdo->prepare($querySecteur);
$stmtSecteur->execute();
$secteurs = $stmtSecteur->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation des données envoyées par le formulaire
    $poste = $_POST['poste'];
    $remune = $_POST['remune'];
    $dateFin = $_POST['dateFin'];
    $dateDebut = $_POST['dateDebut'];
    $nbPlace = $_POST['nbPlace'];
    $descr = $_POST['descr'];
    $secteurId = $_POST['secteur'];

    // Mise à jour de l'offre
    $updateOffreQuery = "UPDATE Offre 
                         SET Poste = :poste, remune = :remune, Date_finO = :dateFin, 
                             Date_debutO = :dateDebut, Nb_place = :nbPlace, Descr = :descr, IDE = :IDE
                         WHERE IDoffre = :IDoffre";
    $stmtUpdateOffre = $pdo->prepare($updateOffreQuery);
    $stmtUpdateOffre->bindParam(':poste', $poste);
    $stmtUpdateOffre->bindParam(':remune', $remune);
    $stmtUpdateOffre->bindParam(':dateFin', $dateFin);
    $stmtUpdateOffre->bindParam(':dateDebut', $dateDebut);
    $stmtUpdateOffre->bindParam(':nbPlace', $nbPlace);
    $stmtUpdateOffre->bindParam(':descr', $descr);
    $stmtUpdateOffre->bindParam(':IDE', $secteurId);
    $stmtUpdateOffre->bindParam(':IDoffre', $offreId);
    $stmtUpdateOffre->execute();

    // Redirection vers le dashboard après mise à jour
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Offre de Stage</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include __DIR__ . "/../views/layout/header.php"; ?>

<main>
    <section class="page-content">
        <h1>Modifier l'Offre de Stage</h1>

        <form action="editOffre.php?id=<?php echo $offre['IDoffre']; ?>" method="POST">
            <label for="poste">Poste</label>
            <input type="text" name="poste" id="poste" value="<?php echo htmlspecialchars($offre['Poste']); ?>" required>

            <label for="remune">Rémunération</label>
            <input type="number" name="remune" id="remune" value="<?php echo htmlspecialchars($offre['remune']); ?>" required>

            <label for="dateDebut">Date de début</label>
            <input type="date" name="dateDebut" id="dateDebut" value="<?php echo htmlspecialchars($offre['Date_debutO']); ?>" required>

            <label for="dateFin">Date de fin</label>
            <input type="date" name="dateFin" id="dateFin" value="<?php echo htmlspecialchars($offre['Date_finO']); ?>" required>

            <label for="nbPlace">Nombre de places</label>
            <input type="number" name="nbPlace" id="nbPlace" value="<?php echo htmlspecialchars($offre['Nb_place']); ?>" required>

            <label for="descr">Description</label>
            <textarea name="descr" id="descr" required><?php echo htmlspecialchars($offre['Descr']); ?></textarea>

            <label for="secteur">Secteur d'activité</label>
            <select name="secteur" id="secteur" required>
                <option value="">-- Choisir un secteur --</option>
                <?php foreach ($secteurs as $secteur): ?>
                    <option value="<?php echo $secteur['IdSec']; ?>" <?php if ($secteur['IdSec'] == $offre['IdSec']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($secteur['Secteur_Act']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Mettre à jour l'offre</button>
        </form>
    </section>
</main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>

</body>
</html>
