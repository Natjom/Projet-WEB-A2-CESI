<?php

class SecteurActiviteModel
{
private $pdo;

public function __construct($pdo)
{
$this->pdo = $pdo;
}

// Récupérer le secteur par son ID
public function getSecteurById($id)
{
$query = "SELECT * FROM Secteur_activite WHERE IdSec = ?";
$stmt = $this->pdo->prepare($query);
$stmt->execute([$id]);
return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
