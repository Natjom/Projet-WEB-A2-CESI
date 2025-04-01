<?php

class Sql
{
    private ?PDO $connexion;

    function __construct($Security_level) 
    {
        // Identifiants selon le niveau de sécurité
        $user = "";
        $password = "";

        switch ($Security_level) 
        {
            case "Administrateur":
                $user = "admin";
                $password = "mdp2";
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
                $user = "etudiant";
                $password = "mdp";
                break;
        }

        // Connexion à la base de données projetweb
        try {
            $this->connexion = new PDO("mysql:host=projetweb.ddns.net;dbname=projetweb;port=3366", $user, $password);
            // Définit le mode d'erreur de PDO pour lancer des exceptions
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            // Affichage d'un message d'erreur si la connexion échoue
            echo "Erreur :". $e->getMessage() . "<br/>";
        }
    }

    // Récupère la première ligne d'un résultat
    public function GetFirstRow($sql) {
        $get = $this->connexion->prepare($sql);
        $get->execute();
        $result = $get->fetchAll();
        return $result[0]; // Retourne la première ligne
    }

    // Récupère le premier enregistrement sous forme d'objet PDO
    public function GetLazy($sql) {
        $get = $this->connexion->prepare($sql);
        $get->execute();
        return $get->fetch(PDO::FETCH_LAZY); 
    }

    // Récupère tous les résultats sous forme de tableau associatif
    public function GetArray($sql) {
        $get = $this->connexion->prepare($sql);
        $get->execute();
        return $get->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau associatif
    }

    // Récupère les résultats sous forme de JSON
    public function Getjson($sql) {
        $get = $this->connexion->prepare($sql);
        $get->execute();
        return json_encode($get->fetchAll()); // Retourne les résultats en format JSON
    }   

    // Exécute une requête SQL générique (INSERT, UPDATE, DELETE)
    public function Set($sql) {
        $set = $this->connexion->prepare($sql);
        return $set->execute(); // Retourne true ou false
    }

    // Ajoute des données à la base de données
    public function Add($sql) {
        try {
            $insert = $this->connexion->exec($sql);
            return ($insert); // Retourne le nombre de lignes affectées
        } catch (Exception $e) {
            echo "Problème de connexion à la base de données...";
            die();
        }
    }

    // Supprime des données de la base
    public function Delete($sql) {
        try {
            $delete = $this->connexion->exec($sql);
            return ($delete); // Retourne le nombre de lignes supprimées
        } catch (Exception $e) {
            echo "Problème de connexion à la base de données... " . $e->getMessage();
            die();
        }
    }

    // Met à jour des données dans la base
    public function Update($sql) {
        try {
            $update = $this->connexion->exec($sql);
            return ($update); // Retourne le nombre de lignes affectées
        } catch (Exception $e) {
            echo "Problème de connexion à la base de données... " . $e->getMessage();
            die();
        }
    }
}

?>
