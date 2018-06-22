<?php ob_start() ?>

<h2> Inscrivez-vous pour acheter ou vendre</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
<div class="formulaire">

    <div class="wrapper">
   
        <form  class="form-signin form" method="post" action="Inscription">
        <div class="help-block helpInscription" ></div>
            <div class="form-group">
                <label for="text">Créez votre pseudo</label>
                    <input  class="form-control" type="text" name="pseudo" placeholder="Pseudo *" value="<?php if(isset($_POST[" pseudo"])) echo ($_POST["pseudo "]) ?>">
                <div class="help-block help" ></div>
            </div>
<hr>
            <div class="form-group">
                <label for="text">Entrez votre adresse mail</label>
                    <input class="form-control email" type="email" name="email" placeholder="Votre e-mail *" value="<?php if(isset($_POST[" email"])) echo ($_POST["email "]) ?>">
                <div class="help-block helpMail" ></div>
            </div>
<hr>
            <div class="form-group">
                <label for="text">Confirmez votre email</label>
                    <input  class="form-control email" type="email" name="emailconf" placeholder="Confirmez votre e-mail *" value="<?php if(isset($_POST["emailconf "])) echo ($_POST["emailconf "]) ?>">
                <div class="help-block helpMail" ></div>
            </div>
<hr>
            <div class="form-group">
                <label for="text">Entrez votre adresse de facturation</label>
                    <input  class="form-control" type="text" name="adressFacture" placeholder="Adresse complète *" value="<?php if(isset($_POST["adressFacture "])) echo ($_POST["adressFacture "]) ?>">
                <div class="help-block help" ></div>
            </div>
<hr>
            <div class="form-group">
                <label for="text">Entrez votre adresse de livraison</label>
                    <input  class="form-control" type="text" name="adressLivraison" placeholder="Adresse complète *" value="<?php if(isset($_POST["adressLivraison"])) echo ($_POST["adressLivraison"]) ?>">
                <div class="help-block help" ></div>
            </div>
<hr>
            <div class="form-group">
                <label for="text">Entrez un mot de passe <br>(Il doit contenir au moins 1 chiffre, 1 lettre en minuscule et 1 lettre en majuscule) </label>
                    <input  class="form-control" type="password" name="password" placeholder="Mot de Passe *">
                <div class="help-block help" ></div>
            </div>
<hr>
            <div class="form-group">
                <label for="text">Confirmez ce mot de passe </label>
                    <input class="form-control" type="password" name="passwordconf" placeholder="Vérification du mot de passe *">
                <div class="help-block help" ></div>
            </div>
<hr>
            <input class="btn" type="submit" value="S'inscrire">

        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>