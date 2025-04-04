    <head>
        <link rel="stylesheet" href="/public/assets/css/entreprise.css">
        <link rel="stylesheet" href="/public/assets/css/styles.css">
        <link rel="stylesheet" href="/public/assets/css/navbar.css">
        <link rel="stylesheet" href="/public/assets/css/footer.css">
    </head>
    <?php include __DIR__ . "/../views/layout/header.php"; ?>

    <main class="entreprise-container">
        <!-- En-tête de l'entreprise -->
        <div class="entreprise-header">
            <h2 class="nom-entreprise">Nom de l'entreprise</h2>
            <div class="note-entreprise">★★★★☆ (4/5)</div>
        </div>

    <!--    <div class="entreprise-header">-->
    <!--        <h2 class="nom-entreprise">--><?php //= $entreprise->nom ?><!--</h2>-->
    <!--        <div class="note-entreprise">--><?php //= str_repeat('★', $entreprise->note). str_repeat('☆', 5 - $entreprise->note)?><!-- (--><?php //= $entreprise->note ?><!--/5)</div>-->
    <!--    </div>-->

        <!-- Informations principales -->
        <div class="entreprise-info">
            <div class="secteur-activite">
                <h3>Secteur d'activité</h3>
                <p>Technologie | Logiciels</p>
            </div>
            <div class="description">
                <h3>Description détaillée</h3>
                <p>Explication détaillée de l'entreprise, sa mission, ses valeurs et ses produits/services.</p>
            </div>
        </div>

        <!-- Contact -->
        <div class="contacts">
            <h3>Contact</h3>
            <ul>
                <li><strong>Site web :</strong> <a href="#">www.entreprise.com</a></li>
                <li><strong>Email :</strong> contact@entreprise.com</li>
                <li><strong>Téléphone :</strong> +33 1 23 45 67 89</li>
                <li><strong>Adresse :</strong> 123 Avenue des Entreprises, 75000 Paris</li>
            </ul>
        </div>
    </main>

    <?php include __DIR__ . "/../views/layout/footer.php"; ?>