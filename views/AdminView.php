<?php ob_start() ?>
<h2>Bonjour "<?= $admin["pseudo"]; ?>", Bienvenue sur votre espace personnel ! </h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
<section class="compte">
<div class="articles admin">
 
   
<?php
  if($reports)  :
      
?>
   
    <img class="avatar" src="public/img/avatars/<?= $admin["avatar"] ?>" alt="<?= $admin["avatar"] ?>">
        <div class="signal">
            <i class='fas fa-exclamation-triangle'></i>
            <h2>Commentaire(s) à modérer!</h2>
            
        </div>  
        
<?php
    endif;
?>
        <article class="commentaires">
<?php
    foreach($reports as $report) :
?>
 
 <p class="date">Posté le <time datetime="<?= $report["publication"] ?>"><?= $report["publication"] ?></time> par <?= $report['pseudo']?> <br> <br>"<?= $report["commentaire"] ?>"</p> 
        <img src="public/img/avatars/<?= $report["avatar"] ?>" alt=" <?= $report["avatar"] ?>">
    
    <a href="Supprimer-un-commentaire&id=<?= $report[3] ?>">Supprimer</a>
    <a  href="Validation&id=<?= $report[3] ?>">Valider</a>
  
<?php

    endforeach;

?>
</article>
<hr>
<h2>Les 5 derniers commentaires publiés</h2>
<?php
    foreach($commentaires as $commentaire) :
?>
    <div class="commentaires">
            <img src="public/img/avatars/<?= $commentaire["avatar"] ?>" alt="<?= $commentaire["avatar"] ?>">
            <p style='margin-top: 30px; ' class="date"> <span> Posté par le membre n°<?= $commentaire["id_membre"] ?> :</span>  <?= $commentaire["pseudo"] ?> <br> <br> le <time datetime="<?= $commentaire["publication"] ?>" ><?= $commentaire["publication"] ?></time>     
            <br><br> "<?= $commentaire["commentaire"] ?>"</p>
            <a style='margin-top: 30px;' class="btn" href="Administration&id=<?= $commentaire['id'] ?>">Supprimer ce commentaire</a>
  

<?php
    endforeach;
?>
<hr>
 <h2>Les 5 derniers membres inscrits</h2>

   
<?php
    foreach($membres as $membre) :
?>
<img  src="public/img/avatars/<?= $membre['avatar'] ?>" alt="<?= $membre['avatar'] ?>">
    <p style='margin-top: 30px;' class="date"><span> Membre n°<?= $membre["id"] ?> :</span>  <?= $membre['pseudo'] ?></p> 
    <a style='margin-top: 30px;' class="btn" href="Administration&id=<?= $membre['id'] ?>">Supprimer</a>

<?php

    endforeach;
?>


</div>
</div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('templates/templateAdmin.php'); ?>