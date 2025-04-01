<head>
    <link rel="stylesheet" href="/style/styles.css">
    <link rel="stylesheet" href="/style/navbar.css">
    <link rel="stylesheet" href="/style/footer.css">
</head>
<?php

include __DIR__ . "/template/header.php";

session_start();
require 'config.php'; // Fichier qui contient la connexion à la BDD

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Identifiants incorrects"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Méthode non autorisée"]);
}


include __DIR__ . "/template/footer.php"; ?>
