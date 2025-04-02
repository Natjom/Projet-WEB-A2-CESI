<?php
$entreprise = new stdClass();
$entreprise->nom = "Nom de l'entreprise";
$entreprise->note = 4;
$entreprise->secteur = "Technologie | Logiciels";
$entreprise->description = "Description détaillée...";
$entreprise->site_web = "www.entreprise.com";
$entreprise->email = "contact@entreprise.com";
$entreprise->telephone = "+33 1 23 45 67 89";
$entreprise->adresse = "123 Avenue des Entreprises, 75000 Paris";

$offre = new stdClass();
$offre->titre = "Stage en Développement Logiciel";
$offre->lieu = "Paris, France";
$offre->duree = "6 mois";
$offre->date_limite = "31/12/2023";
$offre->description = "Description détaillée de la mission...";
$offre->competences = ["PHP", "JavaScript", "Bases de données"];
$offre->instructions = "Envoyez votre CV à contact@entreprise.com";
?>


<head>
    <link rel="stylesheet" href="/public/assets/css/styles.css">
    <link rel="stylesheet" href="/public/assets/css/offre.css">
    <link rel="stylesheet" href="/public/assets/css/entreprise.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
</head>
<?php include __DIR__ . "/../views/layout/header.php"; ?>

<main class="entreprise-container">
    <!-- En-tête de l'entreprise -->
    <div class="entreprise-header">
        <h2 class="nom-entreprise"><?php echo $entreprise->nom; ?></h2>
        <div class="note-entreprise"><?php echo str_repeat('★', $entreprise->note) . str_repeat('☆', 5-$entreprise->note).' (' . $entreprise->note . '/5)'; ?></div>
    </div>

    <!-- Informations principales -->
    <div class="entreprise-info">
        <div class="secteur-activite">
            <h3>Secteur d'activité</h3>
            <p><?php echo $entreprise->secteur; ?></p>
        </div>
        <div class="description">
            <h3>Description détaillée</h3>
            <p><?php echo $entreprise->description; ?></p>
        </div>
    </div>

    <!-- Offre de stage -->
    <div class="offre-container">
        <h2 class="titre-offre"><?php echo $offre->titre; ?></h2>

        <div class="details-offre">
            <div class="detail">
                <span class="libelle">Lieu :</span>
                <span class="valeur"><?php echo $offre->lieu; ?></span>
            </div>
            <div class="detail">
                <span class="libelle">Durée :</span>
                <span class="valeur"><?php echo $offre->duree; ?></span>
            </div>
            <div class="detail">
                <span class="libelle">Date limite :</span>
                <span class="valeur"><?php echo $offre->date_limite; ?></span>
            </div>
        </div>

        <div class="description-offre">
            <h3>Description de la mission</h3>
            <p><?php echo $offre->description; ?></p>
        </div>

        <div class="competences-requises">
            <h3>Compétences requises</h3>
            <ul>
                <?php foreach ($offre->competences as $competence): ?>
                    <li><?php echo $competence; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="comment-postuler">
            <h3>Comment postuler</h3>
            <p><?php echo $offre->instructions; ?></p>
            <button class="btn-postuler">Postuler maintenant</button>
        </div>
    </div>

    <!-- Contact -->
    <div class="contacts">
        <h3>Contact</h3>
        <ul>
            <li><strong>Site web :</strong> <a href="<?php echo $entreprise->site_web; ?>"><?php echo $entreprise->site_web; ?></a></li>
            <li><strong>Email :</strong> <?php echo $entreprise->email; ?></li>
            <li><strong>Téléphone :</strong> <?php echo $entreprise->telephone; ?></li>
            <li><strong>Adresse :</strong> <?php echo $entreprise->adresse; ?></li>
        </ul>
    </div>
</main>

<?php include __DIR__ . "/../views/layout/footer.php"; ?>