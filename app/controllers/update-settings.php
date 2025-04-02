<?php
session_start();

// Vérifie si l'utilisateur est connecté (par exemple, qu'un ID utilisateur est présent)
if (!isset($_SESSION['IDu'])) {
    echo "Non autorisé"; // Si l'utilisateur n'est pas connecté, retourne une erreur
    exit;
}

// Vérifie si les données POST sont présentes
if (isset($_POST['theme']) && isset($_POST['role'])) {
    $theme = $_POST['theme'];
    $role = $_POST['role'];

    // Log des valeurs reçues
    error_log("Paramètres reçus - Thème: $theme, Rôle: $role");

    // Mets à jour les variables de session
    $_SESSION['theme'] = $theme;
    $_SESSION['role'] = $role;

    // Si tu veux aussi mettre à jour des informations en base de données, tu peux ajouter ici le code de mise à jour

    echo "Succès"; // Répond positivement si tout est correct
} else {
    echo "Paramètres manquants"; // Retourne une erreur si les paramètres ne sont pas envoyés correctement
}
?>
