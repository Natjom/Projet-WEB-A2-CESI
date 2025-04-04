<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once(__DIR__ . '/../../config/config.php');
global $pdo;

header('Content-Type: application/json');

if (!isset($_SESSION['id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Non autorisé']);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['name'], $data['surname'], $data['email'], $data['birthdate'])) {
    echo json_encode(['status' => 'error', 'message' => 'Données incomplètes']);
    exit();
}

try {
    $stmt = $pdo->prepare("
        UPDATE Users SET 
            NomU = :name, 
            PrenomU = :surname, 
            MailU = :email, 
            Date_NaisU = :birthdate 
        WHERE IDu = :id
    ");
    $stmt->execute([
        ':name' => $data['name'],
        ':surname' => $data['surname'],
        ':email' => $data['email'],
        ':birthdate' => $data['birthdate'],
        ':id' => $_SESSION['id']
    ]);

    echo json_encode(['status' => 'success', 'message' => 'Profil mis à jour']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Erreur SQL : ' . $e->getMessage()]);
}
