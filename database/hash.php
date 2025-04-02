<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//
//// Connexion à la base de données
//require '../database/PDO.php'; // Inclure ta connexion PDO
//
//// Vérifie si le fichier de verrouillage existe déjà
//if (file_exists('update_done.lock')) {
//    echo "Le script a déjà été exécuté.";
//    exit;  // Arrête le script si le fichier existe
//}
//
//// Crée une instance de la classe Sql
//$sql = new Sql("Etudiant");
//$pdo = $sql->getConnexion(); // Utilise la connexion PDO de la classe Sql
//
//// Récupérer tous les utilisateurs avec leurs mots de passe en clair
//$stmt = $pdo->query("SELECT IDu, MdpU FROM Users");
//
//while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
//    // Vérifier si le mot de passe est en clair
//    $password_clair = $user['MdpU'];
//
//    // Hachage du mot de passe
//    $password_hache = password_hash($password_clair, PASSWORD_DEFAULT);
//
//    // Mise à jour du mot de passe haché dans la base de données
//    $updateStmt = $pdo->prepare("UPDATE Users SET MdpU = ? WHERE IDu = ?");
//    $updateStmt->execute([$password_hache, $user['IDu']]);
//
//    echo "Mot de passe de l'utilisateur " . $user['IDu'] . " mis à jour avec succès.<br>";
//}
//
//// Créer un fichier de verrouillage pour indiquer que le script a été exécuté
//file_put_contents('update_done.lock', 'Le script a été exécuté une fois.');
//
//echo "Tous les mots de passe ont été mis à jour.";
//?>
