<?php

class Sql
{
    public ?PDO $connexion;

    function __construct($Security_level)
    {
        // Identifiants selon le niveau de sécurité
        $user = "";
        $password = "";

        switch ($Security_level)
        {
            case "Administrateur":
                $user = "admin";
                $password = "Mdp@2024!";
                break;

            case "Pilote":
                $user = "pilote";
                $password = "Pilote@123";
                break;

            case "Etudiant":
                $user = "etudiant";
                $password = "Etudiant@123";
                break;

            default:
                error_log("Niveau de sécurité inconnu : $Security_level. Connexion en tant qu'étudiant par défaut.");
                $user = "etudiant";
                $password = "Etudiant@123";
                break;
        }

        // Connexion à la base de données projetweb
        try {
            $this->connexion = new PDO("mysql:host=localhost;dbname=projetweb;port=3306", "root", "4110");
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            // Affichage d'un message d'erreur si la connexion échoue
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    // Récupère la connexion PDO
    public function getConnexion() {
        return $this->connexion;
    }
}
?>
