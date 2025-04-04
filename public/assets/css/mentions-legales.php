<?php
// Vérifiez les droits d'accès (accessible à tous selon la matrice)
session_start();
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'Anonyme';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentions légales - SuperStage</title>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/responsive.css">
</head>
<body>
    <?php include __DIR__ . "/../../src/template/header.php"; ?>

    <main class="page-content">
        <h1>Mentions légales</h1>
        
        <section>
            <h2>Informations légales</h2>
            <p>
                <strong>Editeur :</strong><br>
                Web4All<br>
                Fondé par : Natjom<br>
                SIRET : 12345678901234 <br>
                RCS de Lyon : B 987 654 321<br>
                Code APE : 6202A (Conseil en recrutement et gestion des stages)<br>
                Adresse : 123 Rue de la Technologie, 69001 Lyon, France<br>
                Email : <a href="mailto:contact@web4all.fr">contact@web4all.fr</a><br>
                Téléphone : <a href="tel:+33400000000">+33 4 00 00 00 00</a>
            </p>
        </section>

        <section>
            <h2>Protection des données personnelles</h2>
            <p>
                <strong>Responsable de traitement :</strong><br>
                Web4All - 123 Rue de la Technologie, 69001 Lyon<br>
                
                <strong>Données collectées :</strong><br>
                - Identifiants utilisateurs (nom, prénom, email)<br>
                - Informations de profil (entreprise, secteur, etc.)<br>
                
                <strong>Finalité :</strong><br>
                Gestion des offres de stages et des utilisateurs (pilotes, étudiants, administrateurs)<br>
                
                <strong>Droit d'accès/modification/suppression :</strong><br>
                Vous pouvez demander l'accès, la modification ou la suppression de vos données via 
                <a href="mailto:contact@web4all.fr">contact@web4all.fr</a>.
                
                <strong>Enregistrement CNIL :</strong><br>
                N° Enregistrement CNIL : 2023-0000001 (à remplacer par un enregistrement réel)<br>
                
                <strong>RGPD :</strong><br>
                <a href="/rgpd.php">Lire notre politique de confidentialité</a>
            </p>
        </section>

        <section>
            <h2>Cookies</h2>
            <p>
                Notre site utilise des cookies pour améliorer votre expérience. 
                <a href="/cookies.php">En savoir plus sur notre politique de cookies</a>.
            </p>
        </section>

        <section>
            <h2>Propriété intellectuelle</h2>
            <p>
                Tous les contenus (textes, images, logos) de <strong>SuperStage</strong> sont la propriété exclusive de Web4All.<br>
                Toute reproduction est interdite sauf autorisation préalable.
            </p>
        </section>

        <section>
            <h2>Contact</h2>
            <p>
                Pour toute question, contactez-nous :<br>
                Email : <a href="mailto:contact@web4all.fr">contact@web4all.fr</a><br>
                Téléphone : <a href="tel:+33400000000">+33 4 00 00 00 00</a>
            </p>
        </section>
    </main>

    <?php include __DIR__ . "/../../src/template/footer.php"; ?>
</body>
</html>
