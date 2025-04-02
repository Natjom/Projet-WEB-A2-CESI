<?php
require_once '../controllers/AuthController.php';
require_once '../database/PDO.php';

$authController = new AuthController($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        // Authentification
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($authController->login($email, $password)) {
            header("Location: /SuperStage/index.php");
        } else {
            echo 'Identifiants invalides.';
        }
    } elseif (isset($_POST['register'])) {
        // Inscription
        $email = $_POST['email'];
        $password = $_POST['password'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_naissance = $_POST['date_naissance'];
        $id_adresse = $_POST['id_adresse'];  // Assure-toi que l'adresse existe dans la base de données.

        if ($authController->register($email, $password, $nom, $prenom, $date_naissance, $id_adresse)) {
            echo 'Inscription réussie.';
        } else {
            echo 'Erreur lors de l\'inscription.';
        }
    }
}
?>
