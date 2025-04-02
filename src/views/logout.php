<?php
require_once '../controllers/AuthController.php';
require_once '../database/PDO.php';

$authController = new AuthController($db);
$authController->logout();
?>
