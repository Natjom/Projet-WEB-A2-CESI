<?php
// Inclure le modèle et configurer la connexion à la base de données
require_once __DIR__ . '/../../models/EntrepriseModel.php';

try {
    global $pdo;
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}

$entrepriseModel = new EntrepriseModel($pdo);

$error = '';
$success = '';
$nom = '';
$description = '';
$email = '';
$telephone = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $description = $_POST['description'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';

    // Validation des données
    $valid = true;
    if (empty($nom)) {
        $error .= "Le nom est requis.<br>";
        $valid = false;
    }
    if (empty($description)) {
        $error .= "La description est requise.<br>";
        $valid = false;
    }
    if (empty($email)) {
        $error .= "L'email est requis.<br>";
        $valid = false;
    }
    if (empty($telephone)) {
        $error .= "Le téléphone est requis.<br>";
        $valid = false;
    }

    // Ajouter l'entreprise si les données sont valides
    if ($valid) {
        try {
            $entrepriseModel->ajouterEntreprise($nom, $description, $email, $telephone);
            $success = "L'entreprise a été ajoutée avec succès.";
            // Redirection possible ici vers une page de confirmation
        } catch (PDOException $e) {
            $error = "Erreur lors de l'ajout : " . $e->getMessage();
        }
    }
}
?>

    <head>
        <link rel="stylesheet" href="/public/assets/css/entreprise.css">
        <link rel="stylesheet" href="/public/assets/css/styles.css">
        <link rel="stylesheet" href="/public/assets/css/navbar.css">
        <link rel="stylesheet" href="/public/assets/css/footer.css">
    </head>
<?php include __DIR__ . "/../../views/layout/header.php"; ?>

    <main class="entreprise-container">
        <h2>Ajouter une entreprise</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo nl2br(htmlspecialchars($error)); ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nom">Nom de l'entreprise :</label>
                <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" name="telephone" value="<?php echo htmlspecialchars($telephone); ?>" required>
            </div>
            <button type="submit">Ajouter</button>
        </form>
    </main>

<?php include __DIR__ . "/../../views/layout/footer.php"; ?>