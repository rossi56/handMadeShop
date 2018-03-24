<?php
$title = "Inscription";
$titleHeader = "Inscription";
$image = "public/img/book.png"
?>
<?php ob_start(); ?>

    <div class="formulaire">
    <h3>Inscrivez-vous ! <br> Ne rater pas les derniers Chapitres !</h3>
    
        <form method="post" action="index.php?action=inscription">
<?php
    $erreurs = ControllerMembres::getErreur() ;
    if(isset($erreurs)) :
    if($erreurs) :
// BOUCLE POUR L'AFFICHAGE DES MESSAGES D'ERREURS
    foreach($erreurs as $erreur)  :   
?>
<!-- affichage de ce message en cas d'erreur -->
    <div class="message erreur envoi">
        <?= $erreur ?>
    </div>
<?php
    endforeach;
    else :
?>
    <i class="far fa-check-circle"></i>
    </div>
<?php
    endif;
    endif;
?>
            <input type="text" name="pseudo" placeholder="Pseudo *" value="<?php if(isset($_POST[" pseudo "])) echo ($_POST["pseudo
                                "]) ?>">
            <input type="text" name="email" placeholder="Votre e-mail *" value="<?php if(isset($_POST[" email "])) echo ($_POST["email
                                "]) ?>">
            <input type="email" name="emailconf" placeholder="Confirmez votre e-mail *" value="<?php if(isset($_POST[" emailconf
                                "])) echo ($_POST["emailconf "]) ?>">
            <input type="password" name="password" placeholder="Mot de Passe *">
            <input type="password" name="passwordconf" placeholder="Vérification du mot de passe *">
            <input class="btn-submit" type="submit" value="S'inscrire">
        </form>
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>