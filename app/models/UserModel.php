<?php
class UserModel {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT IDu, MdpU, NomU, PrenomU, MailU, Role FROM Users WHERE MailU = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
