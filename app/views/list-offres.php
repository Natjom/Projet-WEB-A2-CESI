<?php
session_start(); // Si vous utilisez des sessions pour le rôle
require 'database/PDO.php'; // Inclut votre classe Sql

// Détermine le niveau de sécurité (exemple avec session)
// Remplacez par votre logique d'authentification réelle
$securityLevel = $_SESSION['user_role'] ?? 'Etudiant';

// Création de l'instance de connexion
$db = new Sql($securityLevel);
$pdo = $db->getConnexion();

// Le reste du code reste identique à la version précédente
?>
    <head>
        <link rel="stylesheet" href="/public/assets/css/styles.css">
        <link rel="stylesheet" href="/public/assets/css/navbar.css">
        <link rel="stylesheet" href="/public/assets/css/footer.css">
        <link rel="stylesheet" href="/public/assets/css/list-offres.css">
        <title>Liste des offres de stage</title>
    </head>
<?php include __DIR__ . "/../views/layout/header.php"; ?>

    <main class="container">
        <h1>Liste des offres de stage</h1>

        <form method="GET" class="search-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="search-input">Rechercher une offre :</label>
            <input type="text" id="search-input" name="search" placeholder="Titre, entreprise, secteur ou ville..."
                   value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit">Rechercher</button>
        </form>

        <?php
        // Construction de la requête SQL
        $search = $_GET['search'] ?? '';
        $params = [];

        $sql = "SELECT 
                o.IDoffre AS id,
                o.Poste AS titre,
                e.NomE AS entreprise,
                s.Secteur_Act AS domaine,
                v.ville AS ville,
                o.Date_debutO AS date_debut,
                o.Date_finO AS date_fin,
                o.Descr AS description
            FROM Offre o
            JOIN Entreprise e ON o.IDE = e.IDE
            JOIN Secteur_activite s ON e.IdSec = s.IdSec
            JOIN adresse a ON e.ID_adresse = a.ID_adresse
            JOIN ville v ON a.idv = v.idv";

        if (!empty($search)) {
            $sql .= " WHERE o.Poste LIKE :search 
                  OR e.NomE LIKE :search 
                  OR s.Secteur_Act LIKE :search 
                  OR v.ville LIKE :search";
            $params[':search'] = "%$search%";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $offers = $stmt->fetchAll();
        ?>

        <div class="companies-list">
            <?php if (!empty($offers)): ?>
                <?php foreach ($offers as $offer): ?>
                    <div class="company-banner">
                        <a href="../models/offre.php?id=<?= $offer['id'] ?>" class="banner-link">
                            <div class="banner-content">
                                <img src="/public/assets/img/icons/favicon-96x96.png"
                                     alt="<?= htmlspecialchars($offer['entreprise']) ?>"
                                     class="company-logo">
                                <div class="text-content">
                                    <h2><?= htmlspecialchars($offer['titre']) ?></h2>
                                    <div class="details">
                                        <p><strong>Entreprise :</strong> <?= htmlspecialchars($offer['entreprise']) ?></p>
                                        <p><strong>Secteur :</strong> <?= htmlspecialchars($offer['domaine']) ?></p>
                                        <p><strong>Lieu :</strong> <?= htmlspecialchars($offer['ville']) ?></p>
                                        <p><strong>Période :</strong>
                                            <?= date('d/m/Y', strtotime($offer['date_debut'])) ?> -
                                            <?= date('d/m/Y', strtotime($offer['date_fin'])) ?>
                                        </p>
                                        <p><strong>Description :</strong>
                                            <?= htmlspecialchars(substr($offer['description'], 0, 100)) . '...' ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p><?= (!empty($search)) ? "Aucun résultat pour : \"{$search}\"" : "Aucune offre disponible" ?></p>
            <?php endif; ?>
        </div>
    </main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>