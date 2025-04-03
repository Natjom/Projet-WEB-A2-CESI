<?php

class OffreModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter une offre de stage
    public function ajouterOffre(
        $titre,
        $lieu,
        $duree,
        $date_limite,
        $description,
        $competences,
        $instructions,
        $id_entreprise
    ) {
        $query = "INSERT INTO Offre (
            Titre,
            Lieu,
            Duree,
            DateLimite,
            Description,
            Competences,
            Instructions,
            IDEntreprise
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            $titre,
            $lieu,
            $duree,
            $date_limite,
            $description,
            implode(',', $competences), // Stocker les compétences comme une chaîne séparée par des virgules
            $instructions,
            $id_entreprise
        ]);
    }
}