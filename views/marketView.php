<?php ob_start() ?>

<h2>Articles en vente sur "<?= $market[0]['marketName'] ?>"</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
    <img class="logoMarket" src="public/img/market/<?= $market[0]["imgPres"] ?>" alt=" <?= $market[0]["imgPres"] ?>">
        <div class="all">
  
<?php 
    if(count($articles) > 0) :          
    foreach($articles as $article) :
?>
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="public/img/article/<?= $article["img"]; ?>" alt=<?= $article["img"]; ?>>
                    <div class="card-block">
                        <h4 class="card-title"><?= $article["titre"]; ?></h4>
                            <p class="card-text"><?= $article["extrait"]; ?> </p>
                            <p class="price"><span>Prix:</span> <?= $article["price"]; ?> euros</p> 
                                <a class="btn" href="Article&id=<?= $article[0];  ?>">Plus d'infos...</a>
                    </div>  
            </div>
        </div>

<?php
    endforeach;
    else :
?>     

<h2 class="empty" >Aucun article en vente  </h2>

<?php
    endif;
?>
                
</div>
<?php
if(isset($_SESSION['membre'])) :
?>
        <a href="Nouvel-article&id=<?= $market[0]['id'] ?>" class="btn">Créer un nouvel article à mettre en vente</a>
         
<?php
endif;
?>
         
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>
