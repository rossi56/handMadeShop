<?php ob_start() ?>
<h2>Gestion des chapitres publiés sur le blog !</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
        <section class="posts">
            <table>
            <th>Titre</th>
            <th>Image</th>
            <th>Editer</th>
            <th>Supprimer</th>
        <?php
            foreach($chapitres as $chapitre) :
        ?>
            <tr>
                <td><a href="Blog&id= <?= $chapitre["id"] ?>"><?= $chapitre["titre"] ?></a> </td>
                <td><img src="public/img/blog/<?= $chapitre["image_pres"] ?>" alt="<?= $chapitre["image_pres"] ?>"> </td>
                <td><a href="Modifier-un-chapitre&id=<?= $chapitre["id"] ?>"><i class="fas fa-pencil-alt"></i></a></td>
                <td><a href="Supprimer&id=<?= $chapitre["id"] ?>"><i class="fas fa-times"></i></a></td>
            </tr>
        <?php
            endforeach;
        ?>
            </table>
          
            </section> 
         <hr>   
            <h2>Gestion des articles mis en vente dans la boutique !</h2>       
            <section class="posts">
            <table>
            <th>Titre</th>
            <th>Image</th>
            <th>Editer</th>
            <th>Supprimer</th>
        <?php
            foreach($articles as $article) :
        ?>
            <tr>
                <td><a href="Blog&id= <?= $article["id"] ?>"><?= $article["titre"] ?></a> </td>
                <td><img src="public/img/article/<?= $article["img"] ?>" alt="<?= $article["img"] ?>"> </td>
                <td><a href="Modifier-un-article&id=<?= $article["id"] ?>"><i class="fas fa-pencil-alt"></i></a></td>
                <td><a href="SupprimerArt&id=<?= $article["id"] ?>"><i class="fas fa-times"></i></a></td>
            </tr>
        <?php
            endforeach;
        ?>
            </table>
          
            </section>   
<?php $content = ob_get_clean(); ?>
<?php require('templates/templateAdmin.php'); ?>