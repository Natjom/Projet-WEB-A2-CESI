<?php

session_start();

$response = ["status" => "disconnected"];

if (!empty($_SESSION['id'])) {
    $response = [
        "status" => "connected",
        "name" => $_SESSION['name'],
        "role" => $_SESSION['role']
    ];
} elseif (!empty($_COOKIE['session_token'])) {
    // À FAIRE : Vérifier le token en BDD si tu veux le rendre ultra sécurisé
    $response = [
        "status" => "connected",
        "name" => "Utilisateur",
        "role" => "inconnu"
    ];
}

echo json_encode($response);
exit();
