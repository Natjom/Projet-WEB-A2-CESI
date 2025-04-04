<?php
// app/controllers/addEntreprise.php
global $pdo;
session_start();
require_once(__DIR__ . '/../../config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Insérer une nouvelle entreprise vide
    $sql = "INSERT INTO Entreprise (NomE, descr, MailE, TelE, Site, Moyenne, N_siret, IdSec, ID_adresse)
            VALUES ('', '', '', 0, '', 0.00, '', 1, 1)";  // Valeurs par défaut, secteur 1 et adresse 1

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Rediriger vers le dashboard pour voir la nouvelle entrée
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
}
?>
