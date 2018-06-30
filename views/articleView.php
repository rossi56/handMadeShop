<?php 
use Rossi56\controllers\ControllerOneArticle;
ob_start() ?>

    <div class="vente">
        <h2><?= $article["titre"]; ?></h2>
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
<?php
    for($i = 1; $i <= 3; $i++):
?>
            <li data-target="#carouselExampleIndicators"  data-slide-to="<?= $i ?>"><?= $i ?></li>
<?php
    endfor;
?>
            
        </ol>
        <div class="carousel-inner">
<?php
    if(isset($_SESSION["membre"])) :
?>
        <a href="Favoris&id_article=<?= $_GET['id'] ?>"><i class="fas fa-heart"></i></a>
<?php
   endif;
?>
            <div class="carousel-item active">
                <img class="d-block w-100" src="public/img/article/<?= $article["img"]; ?>" alt=<?= $article["img"]; ?>>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="public/img/article/<?= $article["image1"]; ?>" alt=<?= $article["image1"]; ?>>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="public/img/article/<?= $article["image2"]; ?>" alt=<?= $article["image2"]; ?>>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span  aria-hidden="true"><i class="fas fa-angle-left"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span  aria-hidden="true"><i class="fas fa-angle-right"></i></span>
            <span class="sr-only">Next</span>
        </a>
      
    </div>
<section class="article">
    
  
    <section class="achat">
        <h3>Vue d'ensemble</h3>
        <p><span class="favoris">Favoris:<i class="fas fa-heart"></i>  <?= $article["favoris"] ?> </span>
  
<br>
<br>

        <span>Catégorie:</span>  <?= $categorie[0]["name"] ?>  
<br>
<br>

        <span>Sous-Catégorie:</span>  <?= $subCatArt[0]["name"] ?>  
<br>
<br>
        <span>Prix:</span>  <?= $article["price"] ?> euros 
<br>
<br>
        <span>Disponibilité:</span>   <?= $article["disponibility"] ?>  
<br>
<br>
   <span>Mis en vente le</span>   <?= $article["publication"] ?> 
<br>
<br>
   <span>Réalisation:</span>  <?= $article["realisation"] ?>
<br>
<br>
   <span>Evaluation :</span>  <?= $nb_commentaires ?> avis
<br>
<br>
  
<span>Livraison:</span>  <?= $article["livraison"] ?>
<br>
<br>
<span> Depuis le pays:</span> <?= $article["country"] ?> 
<br>
<br>
<span>Tarif: </span> <?= $article["livraisonPrice"] ?> € de livraison dans toute la France
<br>
<br>
<span>Retours:</span>  <?= $article["retours"] ?>
<?php
    if(isset($_SESSION["membre"])) :
?>
        <a class="hvr-curl-top-left" href="Ajouter-au-caddie&id=<?= $article["id"]?>&price=<?= $article["price"]?>&quantite=1">Ajouter au caddie</a>
<?php
   else:
?>
        <a class="hvr-curl-top-left" href="Page-de-connexion">Ajouter au caddie</a>
    
<?php
   endif;
   $vendor = ControllerOneArticle::getVendor();
?>
    </section>
    <div class="card">
        
            <img src="public/img/avatars/<?= $vendor[0]["avatar"] ?>" alt="<?= $vendor[0]["avatar"];  ?>" class="photo">
            <img src="public/img/back.png" alt="Background" class="banner">
            <ul>
            <li><a href="Boutiques&id=<?= $vendor[0]["id"] ?>"> <span style='font-weight: bold;'>Le vendeur:</span> <br> <br> <?= $vendor[0]["pseudo"] ?></a></li>

            </ul>
            <button class="contact" id="main-button">Contactez-moi pour plus d'infos !</button>
            <div class="social-media-banner">
                <a href=""><i class="fab fa-twitter-square"></i></a>
                <a href=""><i class="fab fa-facebook-square"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-linkedin"></i></a>
            </div>
          <form class="email-form form"  method="post" action="Contact">
          <input type="text" name="prenom" placeholder="Votre Prénom *" value="<?php if(isset($_POST[" prenom "])) echo $_POST["prenom"] ?>">
          <input type="text" name="nom" placeholder="Votre Nom *" value="<?php if(isset($_POST[" nom "])) echo $_POST["nom "] ?>">
          <input type="email" name="email" placeholder="Votre e-mail *" value="<?php if(isset($_POST[" email "])) echo $_POST["email"] ?>">
            <textarea id="comment" type="text" name='texte' placeholder="Votre question *"></textarea>
                <button class="contact" type="submit">Envoyer</button>
          </form>
    </div>

    </section>
    
    <section class="description">
        <h2>Description</h2>
    <?= $article["description"]; ?>

    </section>
  
 
    <section class="comments">
   
   
   <?php
       if(isset($_SESSION["membre"])) :
   ?>
        <h2>Laissez un Avis !</h2>
          
   
       <div class="formulaire">
       <div class="wrapper">
           <form id="form" class="form-signin form" method="post" action="Commenter&id=<?= $_GET['id']; ?>">
               <textarea class="form-control" name="commentaire" id="commentaire" cols="30" rows="10" placeholder="Laissez un Avis sur cet article !"></textarea>
            <div class="resultat"></div>
               <div class="help-block helpComment" ></div> <br><br>              
               <input class='btn' type="submit" value="Envoyer !">
           </form>
<?php
    endif;
?>
      <h2 class="avis"><i class="fas fa-star"></i>Avis (<?= $nb_commentaires ?>)</h2>
           <hr>
                
<?php
    foreach($commentaires as $commentaire) :
?>
                       <article class="commentaires">
                           <p class="date">
                               <img src="public/img/avatars/<?= $commentaire["avatar"] ?>" alt="<?= $commentaire["avatar"] ?>">Avis déposé par
                               <?= $commentaire["pseudo"] ?> le
                                   <time datetime="<?= $commentaire["publication"] ?>">
                                       <?= $commentaire["publication"] ?>
                                   </time>
                                  
                           </p>
                           <p class="comment">
                               "<?= $commentaire["commentaire"] ?>"
                           </p>
                               
                           <a  class='btn'  href="Signaler&id=<?= $commentaire['id'] ?>&id_chapitre=<?= $_GET['id'] ?>">Signaler le commentaire</a>
                           <hr>
                       </article>
   
   <?php
       endforeach;  
   ?>
   
       </div>
   </div>
    </section>
   <?php $content = ob_get_clean(); ?>
   <?php require('templates/template.php'); ?>