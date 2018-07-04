<!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="public/css/main.css">
        <link rel="apple-touch-icon" sizes="57x57" href="public/img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="public/img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="public/img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="public/img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="public/img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="public/img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="public/img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="public/img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="public/img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="public/img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="public/img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="public/img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="public/img/favicon/favicon-16x16.png">
        <link rel="manifest" href="public/img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <title>Espace Administration</title>
    </head>

    <body>
        <header>
        <nav>
            <ul id="menu">
                <li> <a  class="hvr-underline-from-center"  href="Blog&page=1">Le Blog</a></li>
                <li> <a  class="hvr-underline-from-center" href="Articles&page=1">La boutique</a> </li>
                <li><a  class="hvr-underline-from-center" href="Publication">Nouveau chapitre</a></li>
                <li><a  class="hvr-underline-from-center" href="Edition">Chapitres publiés</a></li>
                <li><a  class="hvr-underline-from-center" href="Les-Boutiques">Liste des Boutiques</a></li>
                <li><a class="hvr-underline-from-center" href="Compte-utilisateur">Espace Personnel</a></li>
                <li><a  class="hvr-underline-from-center" href="Administration">Administration</a></li>

            </ul>
        </nav>
          
        <div class="burger">
            <svg width="100px" height="100px">
                <path class="top" d="M 30 40 L 70 40 C 90 40 90 75 60 85 A 40 40 0 0 1 20 20 L 80 80"></path>
                <path class="middle" d="M 30 50 L 70 50"></path>
                <path class="bottom" d="M 70 60 L 30 60 C 10 60 10 20 40 15 A 40 38 0 1 1 20 80 L 80 20"></path>
            </svg>
        </div>
        <div class="mask"></div>
            </header>
            
            <section class="container">
              <?= $content ?>
            <div class="scrollTop">
              <i class="fas fa-angle-double-up "></i>
            </div>
            </section>

<script src="public/js/tinymce/tiny_mce.js"></script>
<script src="public/js/tiny.js"></script>
<?php include 'views/footer.php' ?>

