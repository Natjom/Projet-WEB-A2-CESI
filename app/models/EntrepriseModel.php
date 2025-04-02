<?php

class EntrepriseModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllEntreprises()
    {
        $query = "SELECT * FROM Entreprise";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterEntreprise($nom, $description, $email, $telephone)
    {
        $query = "INSERT INTO Entreprise (NomE, descr, MailE, TelE) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$nom, $description, $email, $telephone]);
    }

    public function modifierEntreprise($id, $nom, $description, $email, $telephone)
    {
        $query = "UPDATE Entreprise SET NomE = ?, descr = ?, MailE = ?, TelE = ? WHERE IDE = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$nom, $description, $email, $telephone, $id]);
    }

    public function supprimerEntreprise($id)
    {
        $query = "DELETE FROM Entreprise WHERE IDE = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
    }

    public function rechercherEntreprise($search)
    {
        $query = "SELECT * FROM Entreprise WHERE NomE LIKE ? OR descr LIKE ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['%' . $search . '%', '%' . $search . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
