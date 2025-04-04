<?php
global $pdo;
session_start();
require_once(__DIR__ . "/../../config/config.php");

// Vérification de l'accès : l'utilisateur doit être connecté et avoir le rôle "Pilote"
if ($_SESSION['role'] != 'Pilote') {
    header("Location: /SuperStage/app/views/login.php");
    exit;
}

// Vérification de l'ID de l'entreprise
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Si l'ID n'est pas passé ou est invalide, on redirige vers le dashboard
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
}

// Récupération de l'ID de l'entreprise à éditer
$entrepriseId = $_GET['id'];

// Préparation de la requête pour récupérer les informations de l'entreprise
$query = "SELECT e.*, a.adresseA, v.ville
          FROM Entreprise e
          INNER JOIN adresse a ON e.ID_adresse = a.ID_adresse
          INNER JOIN ville v ON a.idv = v.idv
          WHERE e.IDE = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $entrepriseId, PDO::PARAM_INT);
$stmt->execute();

// Récupération des données de l'entreprise
$entreprise = $stmt->fetch(PDO::FETCH_ASSOC);

// Si l'entreprise n'existe pas, redirection vers le dashboard
if (!$entreprise) {
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
    $nomE = $_POST['NomE'];
    $descr = $_POST['descr'];
    $mailE = $_POST['MailE'];
    $telE = $_POST['TelE'];
    $site = $_POST['Site'];
    $secteurId = $_POST['secteur'];
    $adresseA = $_POST['adresseA'];
    $idVille = $_POST['idVille'];

    // Mise à jour de l'entreprise
    $updateEntrepriseQuery = "UPDATE Entreprise 
                              SET NomE = :NomE, descr = :descr, MailE = :MailE, TelE = :TelE, Site = :Site, IdSec = :IdSec
                              WHERE IDE = :IDE";
    $stmtUpdateEntreprise = $pdo->prepare($updateEntrepriseQuery);
    $stmtUpdateEntreprise->bindParam(':NomE', $nomE);
    $stmtUpdateEntreprise->bindParam(':descr', $descr);
    $stmtUpdateEntreprise->bindParam(':MailE', $mailE);
    $stmtUpdateEntreprise->bindParam(':TelE', $telE);
    $stmtUpdateEntreprise->bindParam(':Site', $site);
    $stmtUpdateEntreprise->bindParam(':IdSec', $secteurId);
    $stmtUpdateEntreprise->bindParam(':IDE', $entrepriseId);
    $stmtUpdateEntreprise->execute();

    // Mise à jour de l'adresse
    $updateAdresseQuery = "UPDATE adresse 
                           SET adresseA = :adresseA, idv = :idv
                           WHERE ID_adresse = :ID_adresse";
    $stmtUpdateAdresse = $pdo->prepare($updateAdresseQuery);
    $stmtUpdateAdresse->bindParam(':adresseA', $adresseA);
    $stmtUpdateAdresse->bindParam(':idv', $idVille);
    $stmtUpdateAdresse->bindParam(':ID_adresse', $entreprise['ID_adresse']);
    $stmtUpdateAdresse->execute();

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
    <title>Modifier l'Entreprise</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include __DIR__ . "/../views/layout/header.php"; ?>

<main>
    <section class="page-content">
        <h1>Modifier l'Entreprise</h1>

        <form action="editEntreprise.php?id=<?php echo $entreprise['IDE']; ?>" method="POST">
            <label for="NomE">Nom de l'entreprise</label>
            <input type="text" name="NomE" id="NomE" value="<?php echo htmlspecialchars($entreprise['NomE']); ?>" required>

            <label for="descr">Description</label>
            <textarea name="descr" id="descr" required><?php echo htmlspecialchars($entreprise['descr']); ?></textarea>

            <label for="MailE">Email</label>
            <input type="email" name="MailE" id="MailE" value="<?php echo htmlspecialchars($entreprise['MailE']); ?>" required>

            <label for="TelE">Téléphone</label>
            <input type="tel" name="TelE" id="TelE" value="<?php echo htmlspecialchars($entreprise['TelE']); ?>" required>

            <label for="Site">Site web</label>
            <input type="url" name="Site" id="Site" value="<?php echo htmlspecialchars($entreprise['Site']); ?>" required>

            <label for="secteur">Secteur d'activité</label>
            <select name="secteur" id="secteur" required>
                <option value="">-- Choisir un secteur --</option>
                <?php foreach ($secteurs as $secteur): ?>
                    <option value="<?php echo $secteur['IdSec']; ?>" <?php if ($secteur['IdSec'] == $entreprise['IdSec']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($secteur['Secteur_Act']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="adresseA">Adresse</label>
            <input type="text" name="adresseA" id="adresseA" value="<?php echo htmlspecialchars($entreprise['adresseA']); ?>" required>

            <label for="idVille">Ville</label>
            <select name="idVille" id="idVille" required>
                <option value="">-- Choisir une ville --</option>
                <?php
                $queryVilles = "SELECT * FROM ville";
                $stmtVilles = $pdo->prepare($queryVilles);
                $stmtVilles->execute();
                $villes = $stmtVilles->fetchAll(PDO::FETCH_ASSOC);

                foreach ($villes as $ville): ?>
                    <option value="<?php echo $ville['idv']; ?>" <?php if ($ville['idv'] == $entreprise['idv']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($ville['ville']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Mettre à jour l'entreprise</button>
        </form>
    </section>
</main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>

</body>
</html>
