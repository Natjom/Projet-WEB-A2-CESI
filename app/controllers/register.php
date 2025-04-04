<?php
// Afficher les erreurs en cas de développement
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once(__DIR__ . "/../../config/config.php");
global $pdo;

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $lastname = trim($_POST['lastname']);
    $firstname = trim($_POST['firstname']);
    $birthdate = $_POST['birthdate'];
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $role = $_POST['role'];
    $adresse = isset($_POST['adresse']) ? trim($_POST['adresse']) : null;
    $villeId = $_POST['ville']; // La ville choisie par l'utilisateur

    // Validation des données
    if (empty($lastname) || empty($firstname) || empty($birthdate) || empty($email) || empty($password) || empty($confirm_password) || empty($role) || empty($villeId)) {
        echo "Tous les champs sont requis.";
        exit();
    }

    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit();
    }

    // Vérifier si l'email est déjà utilisé
    $query = "SELECT COUNT(*) FROM Users WHERE MailU = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "Cet email est déjà utilisé.";
        exit();
    }

    // Hashage du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Enregistrer l'adresse si fournie
    $adresseId = null;
    if ($adresse) {
        // Ajouter l'adresse à la table des adresses (avec la colonne adresseA)
        $query = "INSERT INTO adresse (adresseA, idv) VALUES (:adresse, :villeId)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":adresse", $adresse);
        $stmt->bindParam(":villeId", $villeId, PDO::PARAM_INT);
        $stmt->execute();

        // Récupérer l'ID de l'adresse insérée
        $adresseId = $pdo->lastInsertId();
    } else {
        // Si aucune adresse n'est donnée, on associe l'utilisateur à une adresse sans ligne de rue
        // Dans ce cas, l'adresse reste nulle, mais on assigne l'ID de la ville choisie
        $adresseId = null;
    }

    // Ajouter l'utilisateur dans la table Users
    try {
        $query = "INSERT INTO Users (NomU, PrenomU, Date_NaisU, MailU, MdpU, Role, ID_adresse) 
                  VALUES (:lastname, :firstname, :birthdate, :email, :password, :role, :adresseId)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":firstname", $firstname);
        $stmt->bindParam(":birthdate", $birthdate);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":adresseId", $adresseId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
?>
