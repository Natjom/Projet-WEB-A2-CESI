<?php
// config/config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'projetweb');
define('DB_USER', 'root');  // remplace par ton utilisateur MySQL
define('DB_PASS', '4110');      // remplace par ton mot de passe MySQL

try {
    global $pdo;
    // Configure le PDO pour afficher les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
