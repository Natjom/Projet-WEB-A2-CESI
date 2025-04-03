<?php
// config/config.php
global $pdo;
const DB_HOST = 'localhost';
const DB_NAME = 'projetweb';
const DB_USER = 'utilisateur';
const DB_PASS = '';

try {
    // Configure le PDO pour afficher les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Host: " . DB_HOST . "<br>";
    echo "User: " . DB_USER . "<br>";
    echo "Database: " . DB_NAME . "<br>";
    die();

} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
