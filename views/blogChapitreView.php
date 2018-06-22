<?php ob_start() ?>
   <div class="blogChapitre">
    <h2><?= $chapitre["titre"]; ?></h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">

    <p class="date">Publié le <?= $chapitre["publication"]; ?></p>
    <img src="public/img/blog/<?= $chapitre["image_pres"]; ?>" alt="<?= $chapitre["image_pres"]; ?>">
    <p class='text' ><?= $chapitre["description"]; ?></p>
    <img src="public/img/blog/<?= $chapitre["image1"]; ?>" alt="<?= $chapitre["image1"]; ?>">
    <img src="public/img/blog/<?= $chapitre["image2"]; ?>" alt="<?= $chapitre["image2"]; ?>">
    <img src="public/img/blog/<?= $chapitre["image3"]; ?>" alt="<?= $chapitre["image3"]; ?>">
    
    <section class="comments">
   
   
<?php
    if(isset($_SESSION["membre"])) :
?>

       

    <div class="formulaire">
    <div class="wrapper">
        <form class="form-sign form " method="post" action="Commenter-le-blog&id=<?= $_GET['id']; ?>">
            <textarea class="form-control" name="commentaire" id="commentaire" cols="30" rows="10" placeholder="Laissez un Avis sur cet article !"></textarea>
            <div class="help-block helpComment"></div>
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
                            <?= $commentaire["commentaire"] ?>
                        </p>
                            
                        <a  href="Signaler&id=<?= $commentaire['id'] ?>&id_chapitre=<?= $_GET['id'] ?>">Signaler le commentaire</a>
                        <hr>
                    </article>

<?php
    endforeach;  
?>

    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>