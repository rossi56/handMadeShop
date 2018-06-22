<?php ob_start() ?>
<h2>"Publication d'un chapitre"</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
    <div class="formulaire">
        <div class="wrapper">
            <form class='form-signin form formAdmin' method="post" action="" enctype="multipart/form-data">
                <div class='form-group'>
                <input  class="form-control" type="text" name="titre" placeholder="Titre du Chapitre *" value="<?php if(isset($_POST[" titre "])) echo $_POST["titre "] ?>">
                <div class="help"></div>                  
<hr>            
                </div>
                <div class='form-group'>   
                <label>Insérer la photo de présentation</label>
                <input  class="form-control" type="file" name="file">
                <div class="help-block helpImage"></div>   
<hr>           
                </div>
                <div class='form-group'>        
                <label>Insérer la 1ére photo de l'article</label><br><br>
                <input  class="form-control" type="file" name="file1">
                <div class="help-block helpImage"></div>     
<hr>            
                </div>
                <div class='form-group'>       
                <label>Insérer la 2ème photo de l'article</label><br><br>
                <input  class="form-control" type="file" name="file2">
                <div class="help-block helpImage"></div>    
<hr>            
                </div>
                <div class='form-group'>        
                <label>Insérer la 3ème photo de l'article</label><br><br>
                <input  class="form-control" type="file" name="file3">
                <div class="help-block helpImage"></div>     
<hr>            
                </div>
                <div class='form-group'>        
                <label>Insérer la 4ème photo de l'article</label><br><br>
                <input  class="form-control" type="file" name="file4">
                <div class="help-block helpImage"></div>   
<hr>            
                </div>
                <div class='form-group'>        
                <textarea class="publication" name="description" placeholder="Corps de l'article *"><?php if(isset($_POST["description"])) echo $_POST["description"] ?>
                </textarea> <br><br>
                <div class="help-block helpComment"></div> <br><br>     
                
</div>

                
                <button class="btn" type="submit">Publier</button>
            </form>
        </div>
    </div>
    
<?php $content = ob_get_clean(); ?>
<?php require('templates/templateAdmin.php'); ?>