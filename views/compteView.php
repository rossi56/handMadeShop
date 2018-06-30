<?php ob_start() ?>
<section class="compte">

<div class="articles">
    <h2>Bonjour <span style='font-weight: bold;'>"<?= $compte["pseudo"]; ?>"</span>  <br><br> Bienvenue sur votre espace personnel ! </h2>
    <img class="logo" src="public/img/market/logo3.png" alt="logo">
        <ul class='space'> <p>Sur cet espace, vous pouvez :</p> 
            <li><i class="fas fa-edit"></i>Gérez votre profil</li>
            <li><i class="fas fa-chart-bar"></i>Gérez vos différentes boutiques</li>
            <li><i class="fas fa-plus-square"></i>Ouvrir des boutiques </li>
            <li><i class="far fa-money-bill-alt"></i>Vendre de nouveaux articles</li>
            <li><i class="fas fa-cart-plus"></i>Acheter dans les boutiques</li>
            <li><i class="fas fa-eye"></i>Visualiser vos derniers articles en vente</li>
            <li><i class="fas fa-eye"></i>Visualiser vos commentaires</li>
        </ul>
        <ul class='profil'>
        <img class="avatar" src="public/img/avatars/<?= $compte["avatar"] ?>" alt="<?= $compte["avatar"] ?>">
            <li><span>Votre pseudo :</span> <?= $compte["pseudo"] ?></li>
            <li><span>Votre adresse e-mail :</span> <?= $compte["email"] ?></li>
            <li><span>Votre adresse de facturation:</span> <?= $compte["adressFacture"] ?></li>
            <li><span>Votre adresse de livraison:</span> <?= $compte["adressLivraison"] ?></li>
        </ul>
           
            
            <a class="hvr-curl-top-left btn" href="Edition-du-profil&id=<?= $_SESSION['membre'] ?>"><i class="fas fa-edit"></i>Editer mon profil</a>

            <a class="hvr-curl-top-left btn" href="Ouverture-de-boutique&id=<?= $_SESSION['membre'] ?>"><i class="fas fa-plus-square"></i>Ouvrir une boutique</a>
</div> 
<hr>
<section class="caddie xl">
<h3>Liste de vos boutiques ouvertes</h3>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col"><span>Nom de la boutique</span> </th>
      <th scope="col"><span>Accéder à la boutique</span></th>      
      <th scope="col"><span>Supprimer la boutique</span></th>
    </tr>
  </thead>
<?php
    foreach($markets as $market) :
?>
  <tbody>
    <tr>
        <td> <?= $market['marketName'] ?>   </td>
        <td><a class="erase access btn" href="Ma-boutique&id=<?= $market[0] ?> "><i class="fas fa-arrow-alt-circle-right"></i></a></td>
        <td><a class="erase btn" href="Supprimer-une-boutique&id=<?= $market[0] ?>"><i class="fas fa-times-circle"></i></a></td>
    </tr>
  </tbody>
<?php
    endforeach;
?>


    </table>
    </section>
    <div class="caddieResponsive">
        <h3>Liste de vos boutiques</h3>
        <h2><?= $market['marketName'] ?></h2>
        <a class="erase access btn" href="Ma-boutique&id=<?= $market[0] ?> "><i class="fas fa-arrow-alt-circle-right"></i>Accéder</a>
        <a class="erase btn" href="Supprimer-une-boutique&id=<?= $market[0] ?>"><i class="fas fa-times-circle"></i>Supprimer</a>

    </div>
<hr>
<h3>Vos derniers articles mis en vente</h3>
    <div class="all">
    
<?php
    foreach($userArticles as $userArticle) ://boucle d'affichage des articles
?>

            <div class="card-deck ">
                <div class="card">
                    <img class="card-img-top" src="public/img/article/<?= $userArticle["img"]; ?>" alt=<?= $userArticle["img"]; ?>>
                    <div class="card-block">
                        <h4 class="card-title"><?= $userArticle["titre"]; ?></h4>
                            <p class="card-text"><?= $userArticle["extrait"]; ?> </p>
                            <p class="price"><span>Prix:</span> <?= $userArticle["price"]; ?> euros</p> 
                    </div>    
                </div>
            </div>

<?php
    endforeach;
?>
    </div>
    <hr>
<section class="caddie">
<?php
    if(count($articles) > 0) :
?>
        <h3>Votre Caddie</h3>
        <table class="table table-striped">

  <thead>
    <tr>
      <th scope="col"><span>Produits</span></th>
      <th scope="col"><span>Prix</span></th>
      <th scope="col"><span>Quantité</span></th>
      <th scope="col"><span>Supprimer</span></th>
      <th scope="col"><span>Prix</span></th>
    </tr>
  </thead>
  <?php

    foreach($articles as $article) :
?>
  <tbody>
    <tr>
      <td><a  href="Article&id=<?= $article['id_article'] ?> "> <?= $article["titre"] ?></a>   </td>
      <td><?= $article["price"] ?> euros<img src="public/img/article/<?= $article["img"] ?>" alt="<?= $article["img"] ?>"></td>
      <td>
      
       <a  href="Moins&id=<?= $article['id_article']  ?>"><i class="fas fa-minus-square"></i></a>  
      
      <?= $article["quantite"] ?>

      <a href="Plus&id=<?= $article['id_article'] ?>"><i class="fas fa-plus-square"></i></a>
      
      </td>
      <td><a class="erase " href="Supprimer&id=<?= $article["id_article"] ?>"><i class="fas fa-times-circle"></i></a></td>
      <td><?= $count ?> euros</td>
    </tr>
<?php
    endforeach;
?>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><span> Frais de livraison:</span></td>
    <td><?= $article['livraisonPrice'] ?> euros</td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><span> TVA (20%):</span></td>
    <td><?= ( $article['livraisonPrice'] + $count)*0.2 ?> euros</td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td><span> Prix Total:</span></td>
    <td><?= ($article['livraisonPrice'] + $count)+($article['livraisonPrice'] + $count)*0.2 ?> euros</td>
    </tr>
  </tbody>


            </table>

<div id="bouton-paypal"></div>

            </section> 
<?php
    else :
?>
<h2 class="empty" >Votre panier est vide !</h2>
<?php
    endif;
?>
<hr>
<a class="hvr-curl-top-left open btn" href="Articles&page=1"><i class="fas fa-cart-plus"></i>Accès à tous les articles en vente</a>
<hr>

            <div class="commentaires">
<h3>Vos derniers commentaires de la boutique</h3>   
<?php
    foreach($commentaires as $commentaire) :
?>


    <p class="date">Posté sur l'article " <a href="Article&id=<?= $commentaire["id_article"];  ?>"><?= $commentaire["titre"] ?></a> "  le <time datetime="<?= $commentaire["publication"] ?>"><?= $commentaire["publication"] ?></time> <br> <br>"<?= $commentaire["commentaire"] ?>"</p> 
        <img src="public/img/article/<?= $commentaire["img"] ?>" alt=" <?= $commentaire["img"] ?>">
             <hr>
<?php
    endforeach;
?>
</div> 
<div class="commentaires">
<h3>Vos derniers commentaires sur le blog</h3>   
<?php
    foreach($blogComments as $blogComment) :
?>


    <p class="date">Posté sur l'article " <a href="Chapitre&id=<?= $blogComment["id"];  ?>"><?= $blogComment["titre"] ?></a> "  le <time datetime="<?= $blogComment["publication"] ?>"><?= $blogComment["publication"] ?></time> <br> <br>"<?= $blogComment["commentaire"] ?>"</p> 
        <img src="public/img/blog/<?= $blogComment["image_art"] ?>" alt=" <?= $blogComment["image_art"] ?>">
             <hr>
<?php
    endforeach;
?>
</div> 
            </section>
            </section>

<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>