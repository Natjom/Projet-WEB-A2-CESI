<?php
// Connexion à la base de données (PDO)
global $pdo;
session_start();
require_once(__DIR__ . "/../../config/config.php"); // Assure-toi d'avoir ta connexion ici

// Récupération du terme de recherche
$search = $_GET['search'] ?? '';

// Préparer la requête pour récupérer les offres de stage
$sql = "SELECT O.IDoffre, O.Poste, O.remune, O.Date_debutO, O.Date_finO, O.Nb_place, O.Descr, 
                E.NomE, E.MailE, E.Site, S.Secteur_Act
        FROM Offre O
        LEFT JOIN Entreprise E ON O.IDE = E.IDE
        LEFT JOIN Secteur_activite S ON E.IdSec = S.IdSec
        WHERE O.Poste LIKE :search OR S.Secteur_Act LIKE :search
        ORDER BY O.Date_debutO ASC"; // Trier par date de début du stage

// Préparer la requête
$stmt = $pdo->prepare($sql);

// Lier le paramètre de recherche à la requête
$searchTerm = '%' . $search . '%';
$stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);

// Exécuter la requête
$stmt->execute();

// Récupérer les résultats
$stages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
    <link rel="stylesheet" href="/public/assets/css/list-entreprises.css">
    <title>Liste des offres de stage</title>
</head>
<body>

<?php include __DIR__ . "/../views/layout/header.php"; ?>

<main class="container">
    <h1>Liste des offres de stage</h1>

    <!-- Formulaire de recherche -->
    <form method="GET" class="search-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="search-input">Rechercher un stage :</label>
        <input type="text" id="search-input" name="search" placeholder="Exemple : Poste ou secteur..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
    </form>

    <!-- Affichage des offres de stage -->
    <?php if (!empty($stages)): ?>
        <div class="companies-list">
            <?php foreach ($stages as $stage): ?>
                <div class="companies-banner">
                    <a href="../models/offre.php?id=<?= htmlspecialchars($stage['IDoffre']) ?>" class="banner-link">
                        <div class="banner-content">
                            <!-- Logo de l'entreprise -->
                            <img src="/../../public/assets/img/icons/favicon-96x96.png" alt="<?= htmlspecialchars($stage['NomE']) ?>" class="company-logo">

                            <!-- Contenu texte de l'offre de stage -->
                            <div class="text-content">
                                <h2><?= htmlspecialchars($stage['Poste']) ?></h2>
                                <p><strong>Entreprise :</strong> <?= htmlspecialchars($stage['NomE']) ?></p>
                                <p><strong>Secteur :</strong> <?= htmlspecialchars($stage['Secteur_Act']) ?></p>
                                <p><strong>Contact :</strong> <?= htmlspecialchars($stage['MailE']) ?></p>
                                <p><strong>Site web :</strong> <a href="<?= htmlspecialchars($stage['Site']) ?>" target="_blank"><?= htmlspecialchars($stage['Site']) ?></a></p>
                                <p><strong>Rémunération :</strong> <?= htmlspecialchars($stage['remune']) ?>€</p>
                                <p><strong>Date de début :</strong> <?= htmlspecialchars($stage['Date_debutO']) ?></p>
                                <p><strong>Date de fin :</strong> <?= htmlspecialchars($stage['Date_finO']) ?></p>
                                <p><strong>Places disponibles :</strong> <?= htmlspecialchars($stage['Nb_place']) ?></p>
                            </div>
                        </div>
                    </a>

                    <!-- Affichage de la description de l'offre -->
                    <div class="stage-description">
                        <p><strong>Description :</strong> <?= htmlspecialchars($stage['Descr']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- Message si aucune offre de stage n'a été trouvée -->
        <p>Aucun stage trouvé pour cette recherche.</p>
    <?php endif; ?>
</main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>

</body>
</html>