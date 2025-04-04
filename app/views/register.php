<?php global $pdo;
require_once(__DIR__ . "/../../config/config.php");
?>

<head>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>

<?php include __DIR__ . "/layout/header.php"; ?>


<main>
    <section class="page-content">
        <h1>Créer un compte</h1>

        <form action="/SuperStage/app/controllers/register.php" method="POST" id="register-form">
            <label for="lastname">Nom</label>
            <input type="text" name="lastname" id="lastname" required>

            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" id="firstname" required>

            <label for="birthdate">Date de naissance</label>
            <input type="date" name="birthdate" id="birthdate" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm-password">Confirmer le mot de passe</label>
            <input type="password" name="confirm-password" id="confirm-password" required>

            <label for="role">Rôle</label>
            <select name="role" id="role" required>
                <option value="">-- Choisir un rôle --</option>
                <option value="Etudiant">Étudiant</option>
                <option value="Pilote">Pilote</option>
                <option value="Administrateur">Administrateur</option>
            </select>

            <!-- Sélection de la ville -->
            <label for="ville">Ville</label>
            <select name="ville" id="ville" required>
                <option value="">-- Choisir une ville --</option>
                <?php
                // Récupérer les villes disponibles depuis la base de données
                $query = "SELECT idv, ville FROM ville";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $villes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Afficher les options des villes
                foreach ($villes as $ville) {
                    echo "<option value=\"" . $ville['idv'] . "\">" . $ville['ville'] . "</option>";
                }
                ?>
            </select>

            <!-- Facultatif : adresse -->
            <label for="adresse">Adresse (facultatif)</label>
            <input type="text" name="adresse" id="adresse" placeholder="12 rue Exemple, 75000 Paris">

            <button type="submit">S'inscrire</button>
        </form>
    </section>
</main>

<?php include __DIR__ . "/layout/footer.php"; ?>
