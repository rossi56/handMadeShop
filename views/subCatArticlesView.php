<?php ob_start();
// if(count($subCategories) > 0) :   
?>
<h2>Catégorie <?= $subCategories[0]['name'] ?> </h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
<div class="all">
<?php   
    foreach($subCategories as $subCategorie) :
?>
<div class="card-deck">

        <div class="card">
            <img class="card-img-top" src="public/img/article/<?= $subCategorie["img"];  ?>" alt=<?= $subCategorie["img"]; ?>>
                <div class="card-block">
                    <h4 class="card-title"><?= $subCategorie['titre']; ?></h4>
              <p class="card-text"><?= $subCategorie['extrait']; ?></p>
              <p class="price">Prix: <?= $subCategorie['price']; ?> euros</p>
           
                    <a  class="btn" href="Article&id=<?= $subCategorie['id'];  ?>">Découvrir...</a>
                </div>
            
        </div>
    </div>
<?php
    endforeach;
    // else :
?>
<!-- <h2 class="empty" >Aucun article en vente dans cette catégorie !</h2> -->

<?php
    // endif;
?>
</div>          
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>