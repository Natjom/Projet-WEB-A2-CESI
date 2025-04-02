<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

global $pdo;
require '../database/PDO.php';
require 'auth.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT IDu, MdpU FROM Users WHERE MailU = ?");
    $stmt->execute([$mail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['MdpU'])) {
        $token = generateToken($user['IDu']);
        echo json_encode(["success" => true, "token" => $token]);
    } else {
        echo json_encode(["success" => false, "message" => "Identifiants incorrects"]);
    }
}
?>
