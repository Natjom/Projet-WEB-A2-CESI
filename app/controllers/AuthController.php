<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Démarrez la session
session_start();

// Inclure le fichier de connexion à la base de données
require_once(__DIR__ . '/../../database/PDO.php');

// Initialiser les variables
$error_message = "";

// Vérifier si le formulaire a été soumis
if (isset($_POST['email']) && isset($_POST['password'])) {
    $user_email = trim($_POST['email']);
    $input_password = $_POST['password'];

    // Requête SQL avec jointures pour récupérer les infos utilisateur et son rôle
    $sql = "SELECT IDu, MdpU, NomU, PrenomU, MailU, Role FROM users WHERE MailU = :email";

    // Préparer et exécuter la requête SQL
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $user_email, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe et connexion
    if ($row) {
        $stored_hashed_password = $row['user_password'];
        $input_hashed = hash("sha512", $input_password);

        if ($input_hashed === $stored_hashed_password) {
            // Stocker les informations de l'utilisateur en session
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['email'] = $row['user_email'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['name'] = $row['user_name'];
            $_SESSION['surname'] = $row['user_surname'];

            // Redirection en fonction du rôle
            switch ($_SESSION['role']) {
                case 'admin':
                    header('Location: /views/Admin.php');
                    exit();
                case 'pilote':
                    header('Location: /views/Pilote.php');
                    exit();
                case 'student':
                    header('Location: /views/Discover.php');
                    exit();
                default:
                    header('Location: /views/Login.php');
                    exit();
            }
        } else {
            $error_message = "mot de passe incorrect";
        }
    } else {
        $error_message = "aucun utilisateur trouvé avec ce email";
    }

    // Stocker le message d'erreur dans un cookie pour l'afficher sur la page de connexion
    if ($error_message) {
        setcookie('error_message', $error_message, time() + 10, "/");
    }
}

// Fermer la connexion
$stmt = null;


?>