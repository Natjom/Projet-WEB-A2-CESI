<?php
require_once 'models/User.php';

class AuthController {

    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
    }

    public function login($email, $password) {
        $user = $this->user->checkLogin($email, $password);
        if ($user) {
            session_start();
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public function register($email, $password, $nom, $prenom, $date_naissance, $id_adresse) {
        return $this->user->registerUser($email, $password, $nom, $prenom, $date_naissance, $id_adresse);
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /SuperStage/index.php");
        exit();
    }
}
?>
