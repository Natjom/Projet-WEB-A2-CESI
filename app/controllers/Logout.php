<?php

session_start();
session_destroy();

// Supprime le cookie côté serveur
setcookie("session_token", "", time() - 3600, "/");

header('Content-Type: application/json');
echo json_encode(["status" => "logged_out"]);
exit();
