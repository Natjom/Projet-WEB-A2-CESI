<?php

global $pdo;
session_start();
require_once(__DIR__ . '/../../config/config.php');

// Initialisation de la réponse
$response = ["status" => "error", "message" => ""];

// Vérifier si les données du formulaire sont présentes
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $user_email = trim($_POST['email']);
    $input_password = $_POST['password'];

    // Requête SQL pour récupérer l'utilisateur
    $sql = "SELECT IDu, MdpU, NomU, PrenomU, MailU, Role FROM users WHERE MailU = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $user_email, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe
    if ($row) {
        if (password_verify($input_password, $row['MdpU'])) {
            // Informations de session
            $_SESSION['id'] = $row['IDu'];
            $_SESSION['email'] = $row['MailU'];
            $_SESSION['role'] = $row['Role'];
            $_SESSION['name'] = $row['NomU'];
            $_SESSION['surname'] = $row['PrenomU'];

            // Réponse réussie
            $response = [
                "status" => "success",
                "role" => $_SESSION['role'],
                "name" => $_SESSION['name']
            ];
        } else {
            // Mot de passe incorrect
            $response["message"] = "Mot de passe incorrect";
        }
    } else {
        // Email non trouvé
        $response["message"] = "Aucun utilisateur trouvé";
    }
} else {
    // Données manquantes
    $response["message"] = "Données manquantes";
}

// Renvoi de la réponse au format JSON
header('Content-Type: application/json');
echo json_encode($response);
exit();
