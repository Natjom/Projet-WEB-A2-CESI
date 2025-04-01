<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once(__DIR__ . '/../database/db_connection.php');

$error_message = "";

// Vérifier si le formulaire a été soumis
if (isset($_POST['email']) && isset($_POST['password'])) {
    try {
        // Connexion à la base de données (remplace ces valeurs si nécessaire)
        $conn = new PDO("mysql:host=localhost;dbname=superstage", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $user_email = trim($_POST['email']);
        $input_password = $_POST['password'];

        // Requête SQL pour récupérer les infos utilisateur et son rôle
        $sql = "SELECT IDu, MdpU, NomU, PrenomU, role FROM Utilisateur WHERE MailU = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $user_email, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $stored_password = $row['MdpU']; // Actuellement en clair dans ta BDD

            // Vérification du mot de passe (modifie si tu utilises password_hash() plus tard)
            if ($input_password === $stored_password) {
                // Stocker les infos utilisateur en session
                $_SESSION['id'] = $row['IDu'];
                $_SESSION['email'] = $user_email;
                $_SESSION['role'] = $row['role'];
                $_SESSION['name'] = $row['NomU'];
                $_SESSION['surname'] = $row['PrenomU'];

                // Redirection en fonction du rôle
                switch ($_SESSION['role']) {
                    case 'Administrateur':
                        header('Location: /SuperStage/vues/Admin.php');
                        exit();
                    case 'Pilote':
                        header('Location: /SuperStage/vues/Pilote.php');
                        exit();
                    case 'Etudiant':
                        header('Location: /SuperStage/vues/Discover.php');
                        exit();
                    default:
                        header('Location: /SuperStage/vues/Login.php');
                        exit();
                }
            } else {
                $error_message = "❌ Mot de passe incorrect !";
            }
        } else {
            $error_message = "❌ Aucun utilisateur trouvé avec cet email !";
        }
    } catch (PDOException $e) {
        $error_message = "❌ Erreur de connexion à la base de données : " . $e->getMessage();
    }

    // Stocker le message d'erreur dans un cookie pour l'afficher sur la page de connexion
    if ($error_message) {
        setcookie('error_message', $error_message, time() + 10, "/");
    }
}

// Fermer la connexion
$stmt = null;
$conn = null;

?>
