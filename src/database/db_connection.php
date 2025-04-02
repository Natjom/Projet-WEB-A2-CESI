<?php

// Activer l'affichage des erreurs pour le développement (désactiver en prod)
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';   // Adresse du serveur MySQL
$dbname = 'superstage'; // Nom de la base de données
$username = 'root';     // Nom d'utilisateur MySQL
$password = '';         // Mot de passe MySQL (laisse vide si aucun mot de passe)

// Options pour améliorer la sécurité et les performances
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Afficher les erreurs PDO
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Retourner des tableaux associatifs
    PDO::ATTR_EMULATE_PREPARES => false, // Désactiver l'émulation des requêtes préparées
];

try {
    // Création de l'objet PDO pour la connexion
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, $options);
} catch (PDOException $e) {
    // En cas d'erreur, afficher un message et stopper l'exécution
    die("❌ Erreur de connexion à la base de données : " . $e->getMessage());
}

?>
