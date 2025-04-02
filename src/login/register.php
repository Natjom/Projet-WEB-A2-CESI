<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Email invalide"]);
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO Users (MailU, MdpU, Role, ID_adresse) VALUES (?, ?, 'etudiant', 1)");
    if ($stmt->execute([$mail, $passwordHash])) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'inscription"]);
    }
}
?>
