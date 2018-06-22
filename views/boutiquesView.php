<?php ob_start() ?>

<div class="all">
<img class="logo" src="public/img/market/logo3.png" alt="logo">
<h2>Liste des boutiques de "<?= $markets[0]['pseudo'] ?>"</h2>

<table class="table table-striped">
  <thead>
    <tr>
      <th   scope="col"><span style="font-weight: bold;">Nom de la boutique</span></th>
      <th  scope="col"><span style="font-weight: bold;">Accéder à la boutique</span></th> 
    </tr>
  </thead>
<?php
    foreach($markets as $market) :
?>
  <tbody>
    <tr>
        <td> <?= $market['marketName'] ?></td>
        <td><a class="access btn" href="Boutique-Articles&id=<?= $market[0] ?>"><i class="fas fa-arrow-alt-circle-right"></i></a></td>
      
    </tr>
  </tbody>
<?php
    endforeach;
?>

    </table>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>