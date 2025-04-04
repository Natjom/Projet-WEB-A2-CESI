<?php
// app/controllers/DashboardController.php

require_once(__DIR__ . "/../../config/config.php");

class DashboardController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getEntreprises() {
        $query = "SELECT e.IDE, e.NomE, e.descr, e.Moyenne, e.MailE, e.TelE, s.Secteur_Act, a.adresseA, v.ville
                  FROM Entreprise e
                  JOIN Secteur_activite s ON e.IdSec = s.IdSec
                  JOIN adresse a ON e.ID_adresse = a.ID_adresse
                  JOIN ville v ON a.idv = v.idv";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOffres() {
        $query = "SELECT o.IDoffre, o.Poste, o.remune, o.Date_debutO, o.Date_finO, e.NomE
                  FROM Offre o
                  JOIN Entreprise e ON o.IDE = e.IDE";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
