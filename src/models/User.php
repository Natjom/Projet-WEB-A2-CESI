<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function checkLogin($email, $password) {
        $query = "SELECT * FROM Users WHERE MailU = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['MdpU'])) {
                return $user;
            }
        }
        return null;
    }

    public function registerUser($email, $password, $nom, $prenom, $date_naissance, $id_adresse) {
        $query = "INSERT INTO Users (MdpU, MailU, NomU, PrenomU, Date_NaisU, Role, ID_adresse) 
                  VALUES (:password, :email, :nom, :prenom, :date_naissance, 'etudiant', :id_adresse)";
        $stmt = $this->conn->prepare($query);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":date_naissance", $date_naissance);
        $stmt->bindParam(":id_adresse", $id_adresse);

        return $stmt->execute();
    }
}
?>
