<?php
function checkUserSession() {
    if (isset($_COOKIE['session_token'])) {
        return true; // Vérification plus poussée à implémenter
    }
    return false;
}
