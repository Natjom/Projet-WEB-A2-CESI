<?php
// app/controllers/deleteOffre.php
global $pdo;
session_start();
require_once(__DIR__ . '/../../config/config.php');

// Vérification de l'ID de l'offre
if (isset($_GET['id'])) {
    $idOffre = (int) $_GET['id'];

    // Suppression de l'offre dans la table Offre
    $sql = "DELETE FROM Offre WHERE IDoffre = :idOffre";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idOffre', $idOffre, PDO::PARAM_INT);
    $stmt->execute();

    // Redirection vers le dashboard pour voir la suppression
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
} else {
    // Si l'ID n'est pas spécifié, rediriger vers le dashboard
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
}
?>
