<?php ob_start() ?>
<h2>Catégorie <?= $subCategories[0]['name'] ?> </h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
<div class="all">


<?php            
    foreach($subCategories as $subCategorie) :
?>
<div class="card-deck">

        <div class="card">
            <img class="card-img-top" src="public/img/sous-categories/<?= $subCategorie[3]; ?>" alt=<?= $subCategorie[3]; ?>>
                <div class="card-block">
                    <h4 class="card-title"><?= $subCategorie[1]; ?></h4>
                    <p class="card-text"><?= $subCategorie['description']; ?></p>
           
                    <a  class="btn" href="Sous-Categorie-Articles&id=<?= $subCategorie[0];  ?>">Découvrir...</a>
                </div>
            
        </div>
    </div>
    <?php
    endforeach;
 
?>


</div>          
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>