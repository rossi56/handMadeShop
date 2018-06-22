<?php ob_start() ?>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
<?php
    if(count($articles) > 0) :
    if(isset($_POST["query"])) : //affichage du résultat de recherche s'il y a un résultat
?>
    <h2 class="recherche">Voici le résultat de votre recherche avec "<?= $_POST["query"] ?>"</h2>
<?php
    endif;             
?>

<div class="all">
<?php            
    foreach($articles as $article) ://boucle d'affichage des articles
?>
<div class="card-deck ">
        <div class="card">
            <img class="card-img-top" src="public/img/article/<?= $article["img"]; ?>" alt=<?= $article["img"]; ?>>
                <div class="card-block">
                    <h4 class="card-title"><?= $article["titre"]; ?></h4>
                    <p class="card-text"><?= $article["extrait"]; ?> </p>
              
                <p class="price"><span>Prix:</span> <?= $article["price"]; ?> euros</p> 
           
                    <a  class="btn" href="Article&id=<?= $article["id"];  ?>">Lire la suite...</a>
                </div>
            
        </div>
    </div>
<?php
    endforeach;
    else :
?>
    <h2 class="recherche empty">Aucun résultat pour votre recherche</h2>
<?php
    endif;
?>

</div>          
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>