<?php ob_start() ?>
<h2>"Ouverture de la boutique"</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
    <div class="formulaire">
        <div class="wrapper">
   
            <form class='form-signin form' method="post" action="" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Entrez le nom de votre boutique</label>
                        <input class="form-control" type="text" name="marketName" placeholder="Nom de la boutique *" value="<?php if(isset($_POST[" marketName "])) echo $_POST["marketName"] ?>">
                        <div class="help-block help" ></div>
                </div>  
<hr>
                <div class="form-group">
                    <label>Insérer une image de présentation de la boutique</label>
                        <input  class="form-control image" type="file" name="file">
                        <div class="help-block helpImage" ></div>
                </div>    
<hr>
                <div class="form-group">
                    <label>Entrez la description de votre boutique</label>
                        <textarea class="publication form-control" name="description" placeholder="Corps de l'article *"><?php if(isset($_POST["description"])) echo $_POST["description"] ?>
                        </textarea>
                        <div class="help-block help" ></div>
                </div>     
<hr>
                    <button class="btn" type="submit">Ouvrir la boutique</button>
            </form>

        </div>
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>