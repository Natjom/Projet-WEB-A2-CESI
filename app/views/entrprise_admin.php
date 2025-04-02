<?php
// public/index.php
global $pdo;
require_once __DIR__ . '/../../app/models/EntrepriseModel.php';
require_once __DIR__ . '/../../app/controllers/EntrepriseController.php';
require_once __DIR__ . '/../../config/config.php';

$controller = new EntrepriseController(new EntrepriseModel($pdo));

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'liste':
            $controller->liste();
            break;
        case 'ajouter':
            $controller->ajouter();
            break;
        case 'modifier':
            $controller->modifier($_GET['id']);
            break;
        case 'supprimer':
            $controller->supprimer($_GET['id']);
            break;
        case 'rechercher':
            $controller->rechercher();
            break;
        default:
            $controller->liste();
    }
} else {
    $controller->liste();
}
