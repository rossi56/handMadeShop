<?php ob_start() ?>

    <h2>Modifier l'article <?= $article["titre"] ?></h2>
    <img class="logo" src="public/img/market/logo3.png" alt="logo">
        <div class="formulaire">
            <div class="wrapper">
                <form class="form-signin" method="post" action="Modifier-un-article&id=<?= $article["id"] ?>">
                    <input class="form-control" type="text" name="titre" placeholder="Titre *" value="<?= $article["titre"] ?>"> <br><br>
                    <textarea class="form-control" name="description" ><?= $article["description"] ?></textarea><br><br>
                      <button class="btn" type="submit">Modifier</button>
                </form>
            </div>
        </div>

<?php $content = ob_get_clean(); ?>
<?php require('templates/templateAdmin.php'); ?> 