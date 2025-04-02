<?php
require 'vendor/autoload.php';
use Firebase\JWT\JWT;

define('SECRET_KEY', 'SuperSecretKey123');

function generateToken($userId) {
    $payload = [
        "user_id" => $userId,
        "exp" => time() + 3600
    ];
    return JWT::encode($payload, SECRET_KEY, 'HS256');
}

function verifyToken($token) {
    try {
        $decoded = JWT::decode($token, new \Firebase\JWT\Key(SECRET_KEY, 'HS256'));
        return $decoded->user_id;
    } catch (Exception $e) {
        return false;
    }
}
?>
