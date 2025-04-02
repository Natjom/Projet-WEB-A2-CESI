<?php

$role = $_SESSION['role'] ?? 'inconnu';

$current_page = basename($_SERVER['PHP_SELF']);

if ($role === 'inconnu' && $current_page !== 'Login.php') {
    header('Location: /vues/Login.php');
    exit();
}