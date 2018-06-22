<?php ob_start() ?>

<h2>Connectez-vous</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
    <div class="formulaire">
        <div id="response"></div>
        <div class="wrapper">
            <form id='connexion' class="form-signin form" method="post" name='form' action="Connexion"> 
              
                <div class="form-group">
                <label for="text">Votre Pseudo</label>
                <input  type="text" class="form-control pseudo" name="pseudo" placeholder="Pseudo" onblur="validate('pseudo', this.value)" value="<?php if(isset($_POST["pseudo"])) echo ($_POST["pseudo"]) ?>">
                <div class="help-block help" ></div>
                </div>
                <div class="form-group">
                <label for="text">Votre mot de passe</label>
                <input  class="form-control password" type="password" name="password" onblur="validate('password', this.value)" placeholder="Mot de Passe">
                <div class="help-block help" ></div>
                </div>  
                <input class="btn submit" onclick="checkForm()" type="submit" value="Connexion">
            </form>
        </div>      
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>