<?php
// Configuration de la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=nom_de_votre_base', 'utilisateur', 'mot_de_passe');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}

// Inclure le modèle
require_once __DIR__ . '/../../models/OffreModel.php';
$offreModel = new OffreModel($pdo);

// Variables pour le formulaire
$error = '';
$success = '';
$titre = '';
$lieu = '';
$duree = '';
$date_limite = '';
$description = '';
$competences = [];
$instructions = '';
$id_entreprise = 1; // Par défaut (à adapter selon votre logique)

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'] ?? '';
    $lieu = $_POST['lieu'] ?? '';
    $duree = $_POST['duree'] ?? '';
    $date_limite = $_POST['date_limite'] ?? '';
    $description = $_POST['description'] ?? '';
    $competences = explode(',', $_POST['competences'] ?? ''); // Convertir la chaîne en tableau
    $instructions = $_POST['instructions'] ?? '';
    $id_entreprise = $_POST['id_entreprise'] ?? 1; // À adapter selon votre logique

    // Validation basique
    $valid = true;
    if (empty($titre)) {
        $error .= "Le titre est requis.<br>";
        $valid = false;
    }
    if (empty($lieu)) {
        $error .= "Le lieu est requis.<br>";
        $valid = false;
    }
    if (empty($duree)) {
        $error .= "La durée est requise.<br>";
        $valid = false;
    }
    if (empty($date_limite)) {
        $error .= "La date limite est requise.<br>";
        $valid = false;
    }
    if (empty($description)) {
        $error .= "La description est requise.<br>";
        $valid = false;
    }
    if (empty($instructions)) {
        $error .= "Les instructions de candidature sont requises.<br>";
        $valid = false;
    }

    // Ajouter l'offre si les données sont valides
    if ($valid) {
        try {
            $offreModel->ajouterOffre(
                $titre,
                $lieu,
                $duree,
                $date_limite,
                $description,
                $competences,
                $instructions,
                $id_entreprise
            );
            $success = "L'offre de stage a été ajoutée avec succès.";
        } catch (PDOException $e) {
            $error = "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }
}
?>

    <head>
        <link rel="stylesheet" href="/public/assets/css/styles.css">
        <link rel="stylesheet" href="/public/assets/css/offre.css">
        <link rel="stylesheet" href="/public/assets/css/entreprise.css">
        <link rel="stylesheet" href="/public/assets/css/navbar.css">
        <link rel="stylesheet" href="/public/assets/css/footer.css">
    </head>
<?php include __DIR__ . "/../../views/layout/header.php"; ?>

    <main class="entreprise-container">
        <h2>Ajouter une offre de stage</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo nl2br(htmlspecialchars($error)); ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <!-- Titre -->
            <div class="form-group">
                <label for="titre">Titre de l'offre :</label>
                <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($titre); ?>" required>
            </div>

            <!-- Lieu -->
            <div class="form-group">
                <label for="lieu">Lieu :</label>
                <input type="text" id="lieu" name="lieu" value="<?php echo htmlspecialchars($lieu); ?>" required>
            </div>

            <!-- Durée -->
            <div class="form-group">
                <label for="duree">Durée :</label>
                <input type="text" id="duree" name="duree" value="<?php echo htmlspecialchars($duree); ?>" required>
            </div>

            <!-- Date limite -->
            <div class="form-group">
                <label for="date_limite">Date limite (jj/mm/aaaa) :</label>
                <input type="text" id="date_limite" name="date_limite" value="<?php echo htmlspecialchars($date_limite); ?>" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description de la mission :</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>
            </div>

            <!-- Compétences requises -->
            <div class="form-group">
                <label for="competences">Compétences requises (séparées par des virgules) :</label>
                <input type="text" id="competences" name="competences" value="<?php echo htmlspecialchars(implode(',', $competences)); ?>" required>
            </div>

            <!-- Instructions de candidature -->
            <div class="form-group">
                <label for="instructions">Instructions pour postuler :</label>
                <textarea id="instructions" name="instructions" required><?php echo htmlspecialchars($instructions); ?></textarea>
            </div>

            <!-- ID de l'entreprise (à adapter selon votre logique) -->
            <div class="form-group">
                <label for="id_entreprise">ID de l'entreprise :</label>
                <input type="number" id="id_entreprise" name="id_entreprise" value="<?php echo htmlspecialchars($id_entreprise); ?>" required>
            </div>

            <button type="submit">Ajouter l'offre</button>
        </form>
    </main>

<?php include __DIR__ . "/../../views/layout/footer.php"; ?>