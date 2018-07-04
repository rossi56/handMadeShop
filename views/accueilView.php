<?php
 ob_start() 
?>
<section class="accueil">
    <div class="jumbotron">
        <h1 class="display-3 title">Hand made shop</h1>
            <p class="lead">Imaginez, Créez, Vendez !</p>
                <img class="logo" src="public/img/market/logo3.png" alt="logo">
<hr class="my-4">
       
<?php
    if(isset($_SESSION["membre"])) :
?>
        <p class="lead">
            <a class="btn btn-primary btn-lg hvr-curl-top-left" href="Compte-utilisateur" role="button">Bienvenue <?= $compte["pseudo"] ?> !</a>
        </p>
<?php
    else :
?>
        <p class="lead">
            <a class="btn btn-primary btn-lg hvr-curl-top-left" href="Inscription" role="button">Ouvrez votre boutique !</a>
        </p>

<?php
    endif;
?>

        <h2>Trouvez et vendez facilement ce que vous aimez !</h2>




        
      
    </div>
    <div class="accueilResponsive">
    <h1 class="display-3">Hand made shop</h1>
            <p class="lead">Imaginez, Créez, Vendez !</p>
                <img class="logo" src="public/img/market/logo3.png" alt="logo">
                <p class="lead">

<a class="btn btn-primary btn-lg hvr-curl-top-left" href="Inscription" role="button">Ouvrez votre boutique !</a>
</p>
    <h2>Trouvez et vendez facilement ce que vous aimez !</h2>
    <div class="descResponsive">
        <h3>L'économie selon "Hand made shop"</h3>
                <p>La vision de l'économie que promeut "Hand made shop" voit les entrepreneurs de la création s'épanouir en
                vendant des articles à leurs voisins comme à des curieux qui vivent sur un autre continent et les consommateurs
                dénicher des objets hors du commun fabriqués par des personnes avec qui ils pourront tisser des liens allant
                bien au-delà de l'échange commercial.</p>

    </div>
   
    </div>
    <section class="presentation">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="d-block img-fluid" src="public/img/article/bague-13.png">
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="public/img/article/deco1.jpg">
                </div>
                <div class="carousel-item">
                    <img class="d-block img-fluid" src="public/img/article/brace-1.jpg">
                </div>
            </div>
        </div>
        <div class="pres-right">
            <h2>L'économie selon "Hand made shop"</h2>
                <p>La vision de l'économie que promeut "Hand made shop" voit les entrepreneurs de la création s'épanouir en
                vendant des articles à leurs voisins comme à des curieux qui vivent sur un autre continent et les consommateurs
                dénicher des objets hors du commun fabriqués par des personnes avec qui ils pourront tisser des liens allant
                bien au-delà de l'échange commercial.</p>
        </div>
    </section>
    <section class="descriptions">
        <article class="description">
            <h3>
                <i class="fas fa-check"></i>De l'unique !</h3>
            <p class="p1">Nous avons des dizaines d'articles uniques. Vous pourrez trouver tout ce dont vous avez besoin (ou que vous voulez
                vraiment). </p>
        </article>
        <article class="description">
            <h3>
                <i class="fas fa-check"></i>Des vendeurs indépendants</h3>
            <p class="p2">Passez commande à des personnes qui ont mis tout leur coeur dans la fabrication de choses vraiment spéciales.
                </p>
        </article>
        <article class="description">
            <h3><i class="fas fa-check"></i>Des achats sécurisés</h3>
            <p class="p3">Nous utilisons les meilleures technologies disponibles pour protéger vos transactions. </p>
        </article>
    </section>
<hr>
<h2>Les derniers articles mis en vente</h2>
        <div class="all">
            
       
<?php    
    foreach($articles as $article) ://boucle d'affichage des articles
?>
            <div class="card-deck">
                <div class="card">
                    <img class="card-img-top" src="public/img/article/<?= $article["img"]; ?>" alt=<?= $article["img"]; ?>>
                    <div class="card-block">
                        <h4 class="card-title"><?= $article["titre"]; ?></h4>
                            <p class="card-text"><?= $article["extrait"]; ?></p>
                            <p class="price">Prix: <?= $article["price"]; ?> euros</p>
                                 <a  class="btn" href="Article&id=<?= $article["id"];  ?>">Voir en détail</a>
                    </div>
                </div>
            </div>
<?php
    endforeach;
?>
</div>
<a class="btn" href="Articles&page=1">Accès à tous les articles en vente</a>
    
    <hr>
   
        <section class="avis">
            <h2>Les derniers avis clients</h2>
<?php
    foreach($commentaires as $commentaire) :
?>
            <article class="comments">
                <p class="date"> <img src="public/img/avatars/<?= $commentaire["avatar"] ?>" alt="<?= $commentaire["avatar"] ?>">  <span> Posté par</span>  <?= $commentaire["pseudo"] ?> le <time datetime="<?= $commentaire["publication"] ?>" >
            <?= $commentaire["publication"] ?></time> 
               
                <p class="comment">"<?= $commentaire["commentaire"] ?>"</p>
            </article>
<?php
    endforeach;
?>
        </section>
        <hr>
        <h2>Les derniers articles du blog</h2>
    <section class="all">
            
<?php    
    foreach($chapitres as $chapitre) ://boucle d'affichage des articles
?>
            <div class="card-deck">

        <div class="card">
                <img class="card-img-top" src="public/img/blog/<?= $chapitre["image_pres"]; ?>" alt=<?= $chapitre["image_pres"]; ?>>
                <div class="card-block">
                    <h4 class="card-title"><?= $chapitre["titre"]; ?></h4>
                    <p class="card-text"><?= $chapitre["extrait"]; ?></p>
                    <a  class="btn" href="Chapitre?id=<?= $chapitre["id"];  ?>">Voir en détail</a>
                </div>
            
        </div>
    </div>
<?php
    endforeach;
?>

    </section>
</section>
    <a class="btn" href="Blog&page=1">Accès au blog</a>

<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>


  
  
   
