<?php ob_start() ?>
<h2>Gestion des Boutiques ouvertes !</h2>
        <section class="posts">
            <table>
            <th>Nom</th>
            <th>Logo</th>
            <th>Création</th>
            <th>Supprimer</th>
        <?php
            foreach($boutiques as $boutique) :
        ?>
            <tr>
                <td><a href="Ma-boutique&id= <?= $boutique["id"] ?>"><?= $boutique["marketName"] ?></a> </td>
                <td><img style='width: 40px;' src="public/img/market/<?= $boutique["imgPres"] ?>" alt="<?= $boutique["imgPres"] ?>"> </td>
                <td><?= $boutique["creation"] ?></td>
                <td ><a href="Supprimer&id=<?= $boutique["id"] ?>"><i class="fas fa-times"></i></a></td>
            </tr>
        <?php
            endforeach;
        ?>
            </table>
          
            </section> 
<?php $content = ob_get_clean(); ?>
<?php require('templates/templateAdmin.php'); ?>