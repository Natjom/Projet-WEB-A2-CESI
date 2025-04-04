<?php
// Connexion à la base de données (PDO)
global $pdo;
session_start();
require_once(__DIR__ . "/../../config/config.php"); // Assure-toi d'avoir ta connexion ici

// Récupérer l'ID de l'entreprise depuis l'URL (par exemple : entreprise.php?id=1)
$entreprise_id = $_GET['id'] ?? null;

if ($entreprise_id) {
    // Préparer la requête pour récupérer les informations de l'entreprise et de l'offre de stage
    $sql = "SELECT E.IDE, E.NomE, E.MailE, S.Secteur_Act, E.TelE, E.Site, E.Moyenne, 
                    O.IDoffre, O.Poste, O.remune, O.Date_debutO, O.Date_finO, O.Nb_place, O.Descr
            FROM Entreprise E
            LEFT JOIN Secteur_activite S ON E.IdSec = S.IdSec
            LEFT JOIN Offre O ON E.IDE = O.IDE
            WHERE E.IDE = :entreprise_id";

    // Préparer la requête
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':entreprise_id', $entreprise_id, PDO::PARAM_INT);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer les données de l'entreprise et de l'offre
    $entreprise = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si aucune entreprise n'est trouvée
    if (!$entreprise) {
        echo "Entreprise introuvable.";
        exit;
    }
} else {
    echo "ID de l'entreprise manquant.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/offre.css">
    <link rel="stylesheet" href="/public/assets/css/entreprise.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<body>

<?php include __DIR__ . "/../views/layout/header.php"; ?>

<main class="entreprise-container">
    <!-- En-tête de l'entreprise -->
    <div class="entreprise-header">
        <h2 class="nom-entreprise"><?= htmlspecialchars($entreprise['NomE']) ?></h2>
        <div class="note-entreprise"><?= str_repeat('★', (int)$entreprise['Moyenne']) . str_repeat('☆', 5 - (int)$entreprise['Moyenne']) . ' (' . htmlspecialchars($entreprise['Moyenne']) . '/5)' ?></div>
    </div>

    <!-- Informations principales -->
    <div class="entreprise-info">
        <div class="secteur-activite">
            <h3>Secteur d'activité</h3>
            <p><?= htmlspecialchars($entreprise['Secteur_Act']) ?></p>
        </div>
        <div class="description">
            <h3>Description détaillée</h3>
            <p><?= htmlspecialchars($entreprise['Descr']) ?></p>
        </div>
    </div>

    <!-- Offre de stage -->
    <?php if (!empty($entreprise['IDoffre'])): ?>
        <div class="offre-container">
            <h2 class="titre-offre"><?= htmlspecialchars($entreprise['Poste']) ?></h2>

            <div class="details-offre">
                <div class="detail">
                    <span class="libelle">Lieu :</span>
                    <span class="valeur"><?= htmlspecialchars($entreprise['Lieu']) ?></span>
                </div>
                <div class="detail">
                    <span class="libelle">Durée :</span>
                    <span class="valeur"><?= htmlspecialchars($entreprise['Durée']) ?></span>
                </div>
                <div class="detail">
                    <span class="libelle">Date limite :</span>
                    <span class="valeur"><?= htmlspecialchars($entreprise['Date_limite']) ?></span>
                </div>
            </div>

            <div class="description-offre">
                <h3>Description de la mission</h3>
                <p><?= htmlspecialchars($entreprise['Descr']) ?></p>
            </div>

            <div class="competences-requises">
                <h3>Compétences requises</h3>
                <ul>
                    <?php foreach (explode(',', $entreprise['Competences']) as $competence): ?>
                        <li><?= htmlspecialchars(trim($competence)) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="comment-postuler">
                <h3>Comment postuler</h3>
                <p><?= htmlspecialchars($entreprise['Instructions']) ?></p>
                <button class="btn-postuler">Postuler maintenant</button>
            </div>
        </div>
    <?php endif; ?>

    <!-- Contact -->
    <div class="contacts">
        <h3>Contact</h3>
        <ul>
            <li><strong>Site web :</strong> <a href="<?= htmlspecialchars($entreprise['Site']) ?>" target="_blank"><?= htmlspecialchars($entreprise['Site']) ?></a></li>
            <li><strong>Email :</strong> <?= htmlspecialchars($entreprise['MailE']) ?></li>
            <li><strong>Téléphone :</strong> <?= htmlspecialchars($entreprise['TelE']) ?></li>
            <li><strong>Adresse :</strong> <?= htmlspecialchars($entreprise['Adresse']) ?></li>
        </ul>
    </div>
</main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>

</body>
</html>
