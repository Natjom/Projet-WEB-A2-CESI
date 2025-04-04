<?php
// app/controllers/addOffre.php
global $pdo;
session_start();
require_once(__DIR__ . '/../../config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Insérer une nouvelle offre vide
    $sql = "INSERT INTO Offre (Poste, remune, Date_debutO, Date_finO, Nb_place, Descr, IDE)
            VALUES ('', 0, NULL, NULL, 0, '', 1)";  // Valeurs par défaut, entreprise avec IDE = 1

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Rediriger vers le dashboard pour voir la nouvelle entrée
    header("Location: /SuperStage/app/views/dashboard.php");
    exit;
}
?>
