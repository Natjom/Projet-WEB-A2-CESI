<?php

global $pdo;
session_start();
require_once(__DIR__ . '/../../config/config.php');

$response = ["status" => "error", "message" => ""];

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $user_email = trim($_POST['email']);
    $input_password = $_POST['password'];

    $sql = "SELECT IDu, MdpU, NomU, PrenomU, MailU, Role FROM users WHERE MailU = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $user_email, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        if (password_verify($input_password, $row['MdpU'])) {
            $_SESSION['id'] = $row['IDu'];
            $_SESSION['email'] = $row['MailU'];
            $_SESSION['role'] = $row['Role'];
            $_SESSION['name'] = $row['NomU'];
            $_SESSION['surname'] = $row['PrenomU'];

            // Création d'un token de session (unique à chaque connexion)
            $session_token = bin2hex(random_bytes(32));

            // On met juste le token dans un cookie local
            setcookie("session_token", $session_token, time() + 7 * 24 * 3600, "/", "", isset($_SERVER['HTTPS']), true);

            $response = [
                "status" => "success",
                "role" => $_SESSION['role'],
                "name" => $_SESSION['name'],
                "token" => $session_token // Envoi du token au front
            ];
        } else {
            $response["message"] = "Mot de passe incorrect";
        }
    } else {
        $response["message"] = "Aucun utilisateur trouvé";
    }
} else {
    $response["message"] = "Données manquantes";
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
