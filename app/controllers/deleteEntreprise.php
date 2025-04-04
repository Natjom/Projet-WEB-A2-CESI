<?php
// app/controllers/deleteEntreprise.php
global $pdo;
require_once(__DIR__ . "/../../config/config.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $pdo->bindParam(':id', $id);
    if ($pdo->execute()) {
        header("Location: /SuperStage/app/views/dashboard.php");
    } else {
        echo "Erreur lors de la suppression de l'entreprise.";
    }
} else {
    echo "ID d'entreprise non spécifié.";
}
?>
