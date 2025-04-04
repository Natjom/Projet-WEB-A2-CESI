<?php
// Connexion à la base de données (PDO)
global $pdo;
session_start();
require_once(__DIR__ . "/../../config/config.php"); // Assure-toi d'avoir ta connexion ici

// Récupération du terme de recherche
$search = $_GET['search'] ?? '';

// Préparer la requête pour récupérer les entreprises et leurs offres
$sql = "SELECT E.IDE, E.NomE, E.MailE, S.Secteur_Act, E.TelE, E.Site, E.Moyenne, 
                O.IDoffre, O.Poste, O.remune, O.Date_debutO, O.Date_finO, O.Nb_place, O.Descr
        FROM Entreprise E
        LEFT JOIN Secteur_activite S ON E.IdSec = S.IdSec
        LEFT JOIN Offre O ON E.IDE = O.IDE
        WHERE E.NomE LIKE :search OR S.Secteur_Act LIKE :search
        ORDER BY E.NomE ASC"; // Trier par nom d'entreprise (tu peux changer ce critère si nécessaire)

// Préparer la requête
$stmt = $pdo->prepare($sql);

// Lier le paramètre de recherche à la requête
$searchTerm = '%' . $search . '%';
$stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);

// Exécuter la requête
$stmt->execute();

// Récupérer les résultats
$entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
    <link rel="stylesheet" href="/public/assets/css/list-entreprises.css">
    <title>Liste des entreprises</title>
</head>
<body>

<?php include __DIR__ . "/../views/layout/header.php"; ?>

<main class="container">
    <h1>Liste des entreprises et offres de stage</h1>

    <!-- Formulaire de recherche -->
    <form method="GET" class="search-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="search-input">Rechercher une entreprise :</label>
        <input type="text" id="search-input" name="search" placeholder="Exemple : Nom ou secteur..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
    </form>

    <!-- Affichage des entreprises et leurs offres -->
    <?php if (!empty($entreprises)): ?>
        <div class="companies-list">
            <?php foreach ($entreprises as $company): ?>
                <div class="company-banner">
                    <a href="../models/entreprise.php?id=<?= htmlspecialchars($company['IDE']) ?>" class="banner-link">
                        <div class="banner-content">
                            <!-- Logo de l'entreprise -->
                            <img src="/../../public/assets/img/icons/favicon-96x96.png" alt="<?= htmlspecialchars($company['NomE']) ?>" class="company-logo">

                            <!-- Contenu texte de l'entreprise -->
                            <div class="text-content">
                                <h2><?= htmlspecialchars($company['NomE']) ?></h2>
                                <p><strong>Secteur :</strong> <?= htmlspecialchars($company['Secteur_Act']) ?></p>
                                <p><strong>Contact :</strong> <?= htmlspecialchars($company['MailE']) ?></p>
                                <p><strong>Téléphone :</strong> <?= htmlspecialchars($company['TelE']) ?></p>
                                <p><strong>Site web :</strong> <a href="<?= htmlspecialchars($company['Site']) ?>" target="_blank"><?= htmlspecialchars($company['Site']) ?></a></p>
                                <p><strong>Moyenne des avis :</strong> <?= htmlspecialchars($company['Moyenne']) ?></p>
                            </div>
                        </div>
                    </a>

                    <!-- Affichage des offres de stage de l'entreprise -->
                    <?php if ($company['IDoffre']): ?>
                        <div class="offers-list">
                            <h3>Offres de stage :</h3>
                            <div class="offer-item">
                                <p><strong>Poste :</strong> <?= htmlspecialchars($company['Poste']) ?></p>
                                <p><strong>Rémunération :</strong> <?= htmlspecialchars($company['remune']) ?>€</p>
                                <p><strong>Date de début :</strong> <?= htmlspecialchars($company['Date_debutO']) ?></p>
                                <p><strong>Date de fin :</strong> <?= htmlspecialchars($company['Date_finO']) ?></p>
                                <p><strong>Places disponibles :</strong> <?= htmlspecialchars($company['Nb_place']) ?></p>
                                <p><strong>Description :</strong> <?= htmlspecialchars($company['Descr']) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Message si aucune entreprise ou offre n'a été trouvée -->
        <p>Aucune entreprise ou offre trouvée pour cette recherche.</p>
    <?php endif; ?>
</main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>

</body>
</html>