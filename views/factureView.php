<?php ob_start() ?>

<h2>Ma p'tite Boutique vous remercie pour votre achat</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">

 <p>
  <br>
  <br>

 </p>
 <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Votre n° de facture</th>
      <th scope="col">Total de la facture</th>      
      <th scope="col"> Votre adresse mail</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td><?= $facture['payment_id'] ?></td>
        <td><?= $facture['payment_amount'] ?> euros </td>
        <td><?= $facture['payer_email'] ?></td>
    </tr>
  </tbody>

    </table>
<a href="Compte-utilisateur" style='margin-top: 50px;' class="btn">Retourner sur votre espace personnel.</a>

<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>