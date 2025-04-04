<?php
// app/controllers/deleteEntreprise.php
global $pdo;
session_start();
require_once(__DIR__ . '/../../config/config.php');;

// Vérification de l'ID de l'entreprise
if (isset($_GET['id'])) {
    $idEntreprise = (int) $_GET['id'];

    // Suppression des offres associées à l'entreprise (si elles existent)
    $sqlOffre = "DELETE FROM Offre WHERE IDE = :idEntreprise";
    $stmtOffre = $pdo->prepare($sqlOffre);
    $stmtOffre->bindParam(':idEntreprise', $idEntreprise, PDO::PARAM_INT);
    $stmtOffre->execute();

    // Suppression de l'entreprise
    $sqlEntreprise = "DELETE FROM Entreprise WHERE IDE = :idEntreprise";
    $stmtEntreprise = $pdo->prepare($sqlEntreprise);
    $stmtEntreprise->bindParam(':idEntreprise', $idEntreprise, PDO::PARAM_INT);
    $stmtEntreprise->execute();

    // Redirection vers le dashboard après suppression
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
} else {
    // Si l'ID n'est pas spécifié, rediriger vers le dashboard
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
}
?>
