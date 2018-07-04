<?php ob_start() ?>

<h2>Hand made shop vous remercie pour votre achat</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">

 <p>
  <br>
  <br>

 </p>
 <table class="table table-striped" style='margin-top: 150px;'>
   <h2>Voici le récapitulatif de votre commande <br><br> <?= $facture['last_name'] ?> <?= $facture['first_name']  ?></h2>
  <thead>
    <tr>
      <th scope="col">Votre n° de facture</th>
      <th scope="col">Total de la facture</th>      
      <th scope="col"> Votre adresse mail Paypal</th>
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
<a href="Compte-utilisateur" style='margin-top: 150px; margin-bottom: 175px;' class="btn">Retourner sur votre espace personnel.</a>

<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>