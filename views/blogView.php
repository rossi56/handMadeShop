<?php ob_start() ?>
<img class="logo" src="public/img/market/logo3.png" alt="logo">    
<?php            
    foreach($chapitres as $chapitre) ://boucle d'affichage des articles
?> 
    <figure class="card">
        <img class="card-img-top"src="public/img/blog/<?= $chapitre["image_pres"]; ?>" alt="<?= $chapitre["image_pres"]; ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $chapitre["titre"]; ?></h5>
            <p><?= $chapitre["extrait"]; ?></p>
                    <a  href="Article&id=<?= $chapitre["id"];  ?>" class="btn">Voir en détail</a>
        </div>
    </figure> 
<?php
    endforeach;
?>
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>

                        


                        