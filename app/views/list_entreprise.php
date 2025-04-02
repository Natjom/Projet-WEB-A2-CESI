<?php
// Suppression de la configuration de la base de données (pour la simulation)
// $dbHost, $dbName, $dbUser, $dbPass ne sont plus nécessaires
?>

    <head>
        <link rel="stylesheet" href="/../assets/css/styles.css">
        <link rel="stylesheet" href="/../assets/css/navbar.css">
        <link rel="stylesheet" href="/../assets/css/footer.css">
        <title>Liste des entreprises</title>
    </head>
<?php include __DIR__ . "/../views/layout/header.php"; ?>

    <main class="container">
        <h1>Liste des entreprises</h1>

        <!-- Formulaire de recherche -->
        <form method="GET" class="search-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="search-input">Rechercher une entreprise :</label>
            <input type="text" id="search-input" name="search" placeholder="Exemple : Nom ou secteur..." value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : '') ?>">
            <button type="submit">Rechercher</button>
        </form>

        <?php
        // Simulation des données (remplace la base de données)
        $companies = [
            [
                'id' => 1,
                'nom' => 'Entreprise Tech',
                'secteur' => 'Technologie',
                'ville' => 'Paris',
                'contact' => 'contact@tech.com',
                'logo' => '/icons/favicon-96x96.png'
            ],
            [
                'id' => 1,
                'nom' => 'Agro Solutions',
                'secteur' => 'Agriculture',
                'ville' => 'Lyon',
                'contact' => 'contact@agro.fr',
                'logo' => '/icons/favicon-96x96.png'
            ],
            [
                'id' => 1,
                'nom' => 'Voyages Monde',
                'secteur' => 'Tourisme',
                'ville' => 'Marseille',
                'contact' => 'contact@voyages.com',
                'logo' => '/icons/favicon-96x96.png'
            ],
            [
                'id' => 1,
                'nom' => 'Conseil Stratégique',
                'secteur' => 'Consulting',
                'ville' => 'Nantes',
                'contact' => 'contact@conseil.fr',
                'logo' => '/icons/favicon-96x96.png'
            ],
            [
                'id' => 1,
                'nom' => 'Conseil Stratégique',
                'secteur' => 'Consulting',
                'ville' => 'Nantes',
                'contact' => 'contact@conseil.fr',
                'logo' => '/icons/favicon-96x96.png'
            ],
            [
                'id' => 1,
                'nom' => 'Conseil Stratégique',
                'secteur' => 'Consulting',
                'ville' => 'Nantes',
                'contact' => 'contact@conseil.fr',
                'logo' => '/icons/favicon-96x96.png'
            ],
            [
                'id' => 1,
                'nom' => 'Conseil Stratégique blabalbablabalballablablal',
                'secteur' => 'Consulting',
                'ville' => 'Nantes',
                'contact' => 'contact@conseil.fr',
                'logo' => '/icons/favicon-96x96.png'
            ],
            [
                'id' => 1,
                'nom' => 'Conseil Stratégique',
                'secteur' => 'Consulting',
                'ville' => 'Nantes',
                'contact' => 'contact@conseil.fr',
                'logo' => '/icons/favicon-96x96.png'
            ],
        ];

        // Récupération du terme de recherche
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Filtrage des entreprise (simulation de la requête SQL)
        if (!empty($search)) {
            $searchTerm = '%' . $search . '%';
            $filteredCompanies = array_filter($companies, function ($company) use ($searchTerm) {
                return stripos($company['nom'], $search) !== false
                    || stripos($company['secteur'], $search) !== false;
            });
        } else {
            $filteredCompanies = $companies;
        }
        ?>

        <!-- Affichage des résultats -->
        <?php if (!empty($filteredCompanies)): ?>
            <div class="companies-list">
                <?php foreach ($filteredCompanies as $company): ?>
                    <div class="company-banner">
                        <a href="../models/entreprise.php?id=<?= htmlspecialchars($company['id']) ?>" class="banner-link">
                            <div class="banner-content">
                                <!-- Logo à gauche -->
                                <img src="<?= htmlspecialchars($company['logo']) ?>"
                                     alt="<?= htmlspecialchars($company['nom']) ?>"
                                     class="company-logo">

                                <!-- Contenu texte -->
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
            </div>
        <?php else: ?>
            <!-- Message d'erreur inchangé -->
            <?php if (!empty($search)): ?>
                <p>Aucune entreprise trouvée pour la recherche...</p>
            <?php else: ?>
                <p>Aucune entreprise disponible.</p>
            <?php endif; ?>
        <?php endif; ?>
    </main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>