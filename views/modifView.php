<?php ob_start() ?>

    <h2>Modifier le Chapitre <?= $chapitre["titre"] ?></h2>
    <img class="logo" src="public/img/market/logo3.png" alt="logo">
        <div class="formulaire">
            <div class="wrapper">
                <form class="form-signin" method="post" action="Modifier-un-chapitre&id=<?= $chapitre["id"] ?>">
                    <input class="form-control" type="text" name="titre" placeholder="Titre *" value="<?= $chapitre["titre"] ?>"> <br><br>
                    <textarea class="form-control" name="description" ><?= $chapitre["description"] ?></textarea><br><br>
                      <button class="btn" type="submit">Modifier</button>
                </form>
            </div>
        </div>

<?php $content = ob_get_clean(); ?>
<?php require('templates/templateAdmin.php'); ?> 
  
