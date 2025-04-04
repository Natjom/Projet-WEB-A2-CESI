<?php
// app/controllers/DashboardController.php

require_once(__DIR__ . "/../../config/config.php");

// app/controllers/DashboardAdminController.php

// app/controllers/DashboardController.php

class DashboardAdminController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour récupérer tous les utilisateurs
    public function getUtilisateurs() {
        $sql = "SELECT u.IDu, u.NomU, u.PrenomU, u.MailU, u.Role, a.adresseA
                FROM users u
                LEFT JOIN adresse a ON u.ID_adresse = a.ID_adresse
                ORDER BY u.NomU";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>