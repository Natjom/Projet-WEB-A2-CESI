<?php

session_start();

$response = ["status" => "not_connected"];

if (isset($_SESSION['id'])) {
    $response = [
        "status" => "connected",
        "name" => $_SESSION['name']
    ];
} elseif (isset($_COOKIE['session_token'])) {
    // Vérifier localement que le cookie est présent
    $response = [
        "status" => "connected",
        "name" => $_COOKIE['session_token'] // Stocke juste le token (mais on peut améliorer)
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
