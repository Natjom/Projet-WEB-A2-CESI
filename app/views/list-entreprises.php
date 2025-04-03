<?php
session_start();
require_once __DIR__ . '/../../database/PDO.php'; // Inclut votre classe Sql

// Déterminez le niveau de sécurité (exemple avec session)
$securityLevel = $_SESSION['user_role'] ?? 'Etudiant';

// Connexion à la base de données
$db = new Sql($securityLevel);
$pdo = $db->getConnexion();
?>

    <head>
        <link rel="stylesheet" href="/public/assets/css/styles.css">
        <link rel="stylesheet" href="/public/assets/css/navbar.css">
        <link rel="stylesheet" href="/public/assets/css/footer.css">
        <link rel="stylesheet" href="/public/assets/css/list-entreprises.css">
        <title>Liste des entreprises</title>
    </head>
<?php include __DIR__ . "/../views/layout/header.php"; ?>

    <main class="container">
        <h1>Liste des entreprises</h1>

        <!-- Formulaire de recherche -->
        <form method="GET" class="search-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="search-input">Rechercher une entreprise :</label>
            <input type="text" id="search-input" name="search" placeholder="Nom ou secteur..."
                   value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit">Rechercher</button>
        </form>

        <?php
        // Requête SQL
        $search = $_GET['search'] ?? '';
        $params = [];

        $sql = "SELECT 
                e.IDE AS id,
                e.NomE AS nom,
                s.Secteur_Act AS secteur,
                v.ville AS ville,
                e.MailE AS contact,
                e.Site AS site_web
            FROM Entreprise e
            JOIN Secteur_activite s ON e.IdSec = s.IdSec
            JOIN adresse a ON e.ID_adresse = a.ID_adresse
            JOIN ville v ON a.idv = v.idv";

        if (!empty($search)) {
            $sql .= " WHERE e.NomE LIKE :search 
                 OR s.Secteur_Act LIKE :search";
            $params[':search'] = "%$search%";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <!-- Affichage des résultats -->
        <div class="companies-list">
            <?php if (!empty($companies)): ?>
                <?php foreach ($companies as $company): ?>
                    <div class="company-banner">
                        <a href="../models/entreprise.php?id=<?= $company['id'] ?>" class="banner-link">
                            <div class="banner-content">
                                <!-- Logo (utilisez un chemin réel si disponible) -->
                                <img src="<?= $company['site_web'] ? $company['site_web'] : 'public/assets/img/icons/favicon-96x96.png' ?>"
                                     alt="<?= htmlspecialchars($company['nom']) ?>"
                                     class="company-logo">

                                <div class="text-content">
                                    <h2><?= htmlspecialchars($company['nom']) ?></h2>
                                    <div class="details">
                                        <p><strong>Secteur :</strong> <?= htmlspecialchars($company['secteur']) ?></p>
                                        <p><strong>Ville :</strong> <?= htmlspecialchars($company['ville']) ?></p>
                                        <p><strong>Contact :</strong> <?= htmlspecialchars($company['contact']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p><?= (!empty($search)) ? "Aucune entreprise trouvée pour : \"{$search}\"" : "Aucune entreprise disponible" ?></p>
            <?php endif; ?>
        </div>
    </main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>