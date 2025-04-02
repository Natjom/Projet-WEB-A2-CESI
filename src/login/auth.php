<?php
// Inclure le fichier autoload.php en tenant compte de la structure des dossiers
require __DIR__ . '/../../vendor/autoload.php';  // Adapte le chemin si nécessaire

use Firebase\JWT\JWT;

define('SECRET_KEY', 'SuperSecretKey123');

// Fonction pour générer un token JWT
function generateToken($userId) {
    $payload = [
        "user_id" => $userId,
        "exp" => time() + 3600  // Expiration dans une heure
    ];
    return JWT::encode($payload, SECRET_KEY, 'HS256');
}

// Fonction pour vérifier un token JWT
function verifyToken($token) {
    try {
        $decoded = JWT::decode($token, new \Firebase\JWT\Key(SECRET_KEY, 'HS256'));
        return $decoded->user_id;
    } catch (Exception $e) {
        return false;  // Retourne false si l'authentification échoue
    }
}
?>
