<?php
// Configuration de la base de données
try {
    global $pdo;
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}

// Inclure les modèles
require_once __DIR__ . '/OffreModel.php';
require_once __DIR__ . '/EntrepriseModel.php';

$offreModel = new OffreModel($pdo);
$entrepriseModel = new EntrepriseModel($pdo);

// Récupérer l'ID de l'offre depuis l'URL
$id_offre = $_GET['id'] ?? null;

if (!$id_offre) {
    die("ID de l'offre non spécifié.");
}

// Récupérer l'offre depuis la base de données
$offre = $offreModel->getOffreById($id_offre);
if (!$offre) {
    die("Offre introuvable.");
}

// Récupérer l'entreprise associée
$entreprise = $entrepriseModel->getEntrepriseById($offre['IDE']);
?>

    <head>
        <link rel="stylesheet" href="/public/assets/css/styles.css">
        <link rel="stylesheet" href="/public/assets/css/offre.css">
        <link rel="stylesheet" href="/public/assets/css/entreprise.css">
        <link rel="stylesheet" href="/public/assets/css/navbar.css">
        <link rel="stylesheet" href="/public/assets/css/footer.css">
    </head>
<?php include __DIR__ . "/../views/layout/header.php"; ?>

    <main class="offre-container">
        <!-- En-tête de l'entreprise -->
        <div class="entreprise-header">
            <h2 class="nom-entreprise"><?php echo htmlspecialchars($entreprise['NomE']); ?></h2>
            <div class="note-entreprise">
                <?php
                $moyenne = $entreprise['Moyenne'] ?? 0;
                $etoiles = ceil($moyenne);
                echo str_repeat('★', $etoiles) . str_repeat('☆', 5 - $etoiles) . ' (' . $moyenne . '/5)';
                ?>
            </div>
        </div>

        <!-- Détails de l'offre -->
        <div class="offre-details">
            <h2><?php echo htmlspecialchars($offre['Poste']); ?></h2>
            <div class="info">
                <span class="label">Date de début :</span>
                <span class="value"><?php echo htmlspecialchars($offre['Date_debutO']); ?></span>
            </div>
            <div class="info">
                <span class="label">Date de fin :</span>
                <span class="value"><?php echo htmlspecialchars($offre['Date_finO']); ?></span>
            </div>
            <div class="info">
                <span class="label">Nombre de places :</span>
                <span class="value"><?php echo htmlspecialchars($offre['Nb_place']); ?></span>
            </div>
            <div class="info">
                <span class="label">Rémunération :</span>
                <span class="value"><?php echo $offre['remune'] ? 'Oui' : 'Non'; ?></span>
            </div>
        </div>

        <!-- Description de l'offre -->
        <div class="description">
            <h3>Description de la mission</h3>
            <p><?php echo htmlspecialchars($offre['Descr']); ?></p>
        </div>

        <!-- Contact -->
        <div class="contacts">
            <h3>Contact</h3>
            <ul>
                <li><strong>Site web :</strong> <a href="<?php echo htmlspecialchars($entreprise['Site']); ?>"><?php echo htmlspecialchars($entreprise['Site']); ?></a></li>
                <li><strong>Email :</strong> <?php echo htmlspecialchars($entreprise['MailE']); ?></li>
                <li><strong>Téléphone :</strong> <?php echo htmlspecialchars($entreprise['TelE']); ?></li>
            </ul>
        </div>
    </main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>