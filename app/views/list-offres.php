<?php
// Suppression de la configuration de la base de données (pour la simulation)
// $dbHost, $dbName, $dbUser, $dbPass ne sont plus nécessaires
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

        <!-- Formulaire de recherche -->
        <form method="GET" class="search-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="search-input">Rechercher une offre :</label>
            <input type="text" id="search-input" name="search" placeholder="Exemple : Titre, entreprise, ou ville..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
            <button type="submit">Rechercher</button>
        </form>

        <?php
        // Simulation des données (remplace la base de données)
        $offers = [
            [
                'id' => 1,
                'titre' => 'Stage en développement web',
                'entreprise' => 'Tech Solutions',
                'domaine' => 'Technologie',
                'ville' => 'Paris',
                'date_debut' => '2024-01-01',
                'date_fin' => '2024-06-30',
                'description' => 'Recherche un stagiaire pour développer des applications web.',
                'logo' => '/icons/favicon-96x96.png'
            ],
            [
                'id' => 2,
                'titre' => 'Stage en agriculture durable',
                'entreprise' => 'Agro Solutions',
                'domaine' => 'Agriculture',
                'ville' => 'Lyon',
                'date_debut' => '2024-02-15',
                'date_fin' => '2024-08-15',
                'description' => 'Stage sur les techniques agricoles innovantes.',
                'logo' => '/icons/favicon-96x96.png'
            ],
            [
                'id' => 3,
                'titre' => 'Stage en marketing digital',
                'entreprise' => 'Voyages Monde',
                'domaine' => 'Tourisme',
                'ville' => 'Marseille',
                'date_debut' => '2024-03-01',
                'date_fin' => '2024-08-31',
                'description' => 'Création de campagnes marketing pour destinations touristiques.',
                'logo' => '/icons/favicon-96x96.png'
            ],
            // Ajoutez d'autres offres ici...
        ];

        // Récupération du terme de recherche
        $search = $_GET['search'] ?? '';

        // Filtrage des offres (simulation de la requête SQL)
        if (!empty($search)) {
            $searchTerm = strtolower($search);
            $filteredOffers = array_filter($offers, function ($offer) use ($searchTerm) {
                return stripos($offer['titre'], $search) !== false
                    || stripos($offer['entreprise'], $search) !== false
                    || stripos($offer['domaine'], $search) !== false
                    || stripos($offer['ville'], $search) !== false;
            });
        } else {
            $filteredOffers = $offers;
        }
        ?>

        <!-- Affichage des résultats -->
        <?php if (!empty($filteredOffers)): ?>
            <div class="companies-list">
                <?php foreach ($filteredOffers as $offer): ?>
                    <div class="company-banner">
                        <a href="../models/offre.php?id=<?= htmlspecialchars($offer['id']) ?>" class="banner-link">
                            <div class="banner-content">
                                <!-- Logo à gauche -->
                                <img src="<?= htmlspecialchars($offer['logo']) ?>"
                                     alt="<?= htmlspecialchars($offer['entreprise']) ?>"
                                     class="company-logo">

                                <!-- Contenu texte -->
                                <div class="text-content">
                                    <h2><?= htmlspecialchars($offer['titre']) ?></h2>
                                    <div class="details">
                                        <p><strong>Entreprise :</strong> <?= htmlspecialchars($offer['entreprise']) ?></p>
                                        <p><strong>Secteur :</strong> <?= htmlspecialchars($offer['domaine']) ?></p>
                                        <p><strong>Lieu :</strong> <?= htmlspecialchars($offer['ville']) ?></p>
                                        <p><strong>Periode :</strong> <?= htmlspecialchars($offer['date_debut']) ?> - <?= htmlspecialchars($offer['date_fin']) ?></p>
                                        <p><strong>Description :</strong> <?= htmlspecialchars(substr($offer['description'], 0, 100)) . '...' ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Message d'erreur -->
            <?php if (!empty($search)): ?>
                <p>Aucune offre trouvée pour la recherche : « <?= htmlspecialchars($search) ?> ».</p>
            <?php else: ?>
                <p>Aucune offre de stage disponible.</p>
            <?php endif; ?>
        <?php endif; ?>
    </main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>