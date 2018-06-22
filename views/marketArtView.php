<?php ob_start() ?>

<h2>Articles en vente sur "<?= $markets[0]['marketName'] ?>"</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
    <img class="logoMarket" src="public/img/market/<?= $markets[0]["imgPres"] ?>" alt=" <?= $markets[0]["imgPres"] ?>">
        <div class="all">
  
<?php          
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
?>     

                
</div>

         
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>