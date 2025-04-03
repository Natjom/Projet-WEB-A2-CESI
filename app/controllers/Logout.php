<?php
session_start();  // Démarre la session
session_destroy();  // Détruit la session active

// Supprime le cookie de session
setcookie("session_token", "", time() - 3600, "/");

// Redirection vers la page d'accueil ou login
header('Location: /SuperStage/public/index.php');  // Redirige vers l'index
exit();
