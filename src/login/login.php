<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Instancier la classe Sql avec un niveau de sécurité, ici on va utiliser "Etudiant" par défaut
require '../database/PDO.php';
require 'auth.php';

header('Content-Type: application/json');  // Spécifie que la réponse sera en JSON

// Crée une instance de la classe Sql
$sql = new Sql("Etudiant");
$pdo = $sql->getConnexion(); // Utilise la connexion PDO de la classe Sql

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifie si les paramètres sont passés dans la requête
    $mail = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($mail) || empty($password)) {
        // Retourner une erreur si l'email ou le mot de passe est manquant
        echo json_encode(["success" => false, "message" => "Les champs email et mot de passe sont requis."]);
        exit;
    }

    try {
        // Préparation de la requête SQL
        $stmt = $pdo->prepare("SELECT IDu, MdpU FROM Users WHERE MailU = ?");
        $stmt->execute([$mail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['MdpU'])) {
            // Si les identifiants sont valides, générer un token JWT
            $token = generateToken($user['IDu']);
            echo json_encode(["success" => true, "token" => $token]);
        } else {
            // Retourner une erreur si les identifiants sont incorrects
            echo json_encode(["success" => false, "message" => "Identifiants incorrects"]);
        }
    } catch (PDOException $e) {
        // Gérer les erreurs de base de données
        echo json_encode(["success" => false, "message" => "Erreur de base de données : " . $e->getMessage()]);
    }
} else {
    // Retourner une erreur si la méthode n'est pas POST
    echo json_encode(["success" => false, "message" => "Méthode HTTP non autorisée."]);
}
?>
