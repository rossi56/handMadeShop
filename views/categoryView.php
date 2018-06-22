<?php ob_start() ?>
<h2>Les Catégories </h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
<div class="all">


<?php            
    foreach($categories as $categorie) :
?>
<div class="card-deck">

        <div class="card">
            <img class="card-img-top" src="public/img/categories/<?= $categorie["img"]; ?>" alt=<?= $categorie["img"]; ?>>
                <div class="card-block">
                    <h4 class="card-title"><?= $categorie["name"]; ?></h4>
                    <p class='card-text' ><?= $categorie["description"]; ?></p>
                    <a  class="btn" href="Les-sous-Categories&id=<?= $categorie['id'] ?>">Suite...</a>
                </div>
            
        </div>
    </div>
    <?php
    endforeach;
 
?>


</div>          
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>