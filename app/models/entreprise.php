<?php
// Configuration de la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=nom_de_votre_base', 'utilisateur', 'mot_de_passe');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}

// Inclure les modèles
require_once __DIR__ . '/EntrepriseModel.php'; // Ajuster le chemin
require_once __DIR__ . '/SecteurActiviteModel.php'; // Ajout du modèle pour le secteur
$entrepriseModel = new EntrepriseModel($pdo);
$secteurModel = new SecteurActiviteModel($pdo);

// Récupérer l'ID de l'entreprise depuis l'URL
$id_entreprise = $_GET['id'] ?? null;

if (!$id_entreprise) {
    die("ID de l'entreprise non spécifié.");
}

// Récupérer l'entreprise depuis la base de données
$entreprise = $entrepriseModel->getEntrepriseById($id_entreprise);
if (!$entreprise) {
    die("Entreprise introuvable.");
}

// Récupérer le secteur d'activité via IdSec
$secteur = $secteurModel->getSecteurById($entreprise['IdSec']);
?>

    <head>
        <link rel="stylesheet" href="/public/assets/css/entreprise.css">
        <link rel="stylesheet" href="/public/assets/css/styles.css">
        <link rel="stylesheet" href="/public/assets/css/navbar.css">
        <link rel="stylesheet" href="/public/assets/css/footer.css">
    </head>
<?php include __DIR__ . "/../views/layout/header.php"; ?>

    <main class="entreprise-container">
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

        <!-- Informations principales -->
        <div class="entreprise-info">
            <div class="secteur-activite">
                <h3>Secteur d'activité</h3>
                <p><?php echo htmlspecialchars($secteur['Secteur_Act'] ?? 'Non spécifié'); ?></p>
            </div>
            <div class="description">
                <h3>Description détaillée</h3>
                <p><?php echo htmlspecialchars($entreprise['descr']); ?></p>
            </div>
        </div>

        <!-- Contact -->
        <div class="contacts">
            <h3>Contact</h3>
            <ul>
                <li><strong>Site web :</strong> <a href="<?php echo htmlspecialchars($entreprise['Site']); ?>"><?php echo htmlspecialchars($entreprise['Site']); ?></a></li>
                <li><strong>Email :</strong> <?php echo htmlspecialchars($entreprise['MailE']); ?></li>
                <li><strong>Téléphone :</strong> <?php echo htmlspecialchars($entreprise['TelE']); ?></li>
                <li><strong>SIRET :</strong> <?php echo htmlspecialchars($entreprise['N_siret']); ?></li>
            </ul>
        </div>
    </main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>