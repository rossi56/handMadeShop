<?php ob_start() ?>

        <h2>Mettre en vente un nouvel article sur "<?= $market[0]['marketName']  ?>"</h2>
        <img class="logo" src="public/img/market/logo3.png" alt="logo">

            <div class="formulaire">
                <div class="wrapper">
                    
                    <form class='form-signin form' method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label>Nom de votre nouvel article</label>
                                <input type="text" class="form-control"  name="titre" placeholder="Nom de l'article *" value="<?php if(isset($_POST["titre"])) echo $_POST["titre"] ?>">
                                <div class="help-block help" ></div>                        
                        </div>
<hr>
                        <div class="form-group">
                            <label>Insérer la photo de présentation</label> 
                                <input  class="form-control" type="file" name="file1"> 
                        <div class="help-block helpImage" ></div>
                        </div>
<hr>
                        <div class="form-group">
                            <label>Insérer la 1ére photo de l'article</label>
                                <input  class="form-control" type="file" name="file2">
                        <div class="help-block helpImage" ></div>
                        </div>
<hr>
                        <div class="form-group">
                            <label>Insérer la 2ème photo de l'article</label>
                                <input  class="form-control" type="file" name="file3">
                        <div class="help-block helpImage" ></div>
                        </div>
<hr>
                        <div class="form-group">
                            <label>Sélectionnez la catégorie</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Catégorie</label>
                        </div>
                            <select name="category" class="custom-select" id="inputGroupSelect01" >
                                <option  selected>Sélection de la catégorie...</option>
<?php
    foreach($categories as $categorie ) :
?>
                                <option value="<?= $categorie['id'] ?>"><?= $categorie['name'] ?></option>
<?php
    endforeach;
?>
                            </select>
                        </div>
                        <div class="help-block helpCategory" ></div>
                        </div>
<hr>
                        <div class="form-group">
                        <label>Sélectionnez la sous-catégorie</label>
                        <div class="input-group mb-3" >
                            <div class="input-group-prepend" >
                                <label class="input-group-text" for="inputGroupSelect01">Sous-Catégorie</label>
                            </div>

                            <select  name="subCategory" class="custom-select" id="inputGroupSelect01" >
                                <option  selected>Sélection de la sous-catégorie...</option>
<?php
    foreach($subCategories as $subCategorie ) :
?>
                                <option value="<?= $subCategorie['id']  ?>" ><?= $subCategorie['name'] ?></option>
<?php
    endforeach;
?>
                        </select>
                    </div>
                    <div class="help-block helpSubCategory" ></div>
                    </div>
<hr>
                    <div class="form-group">
                        <label>Disponiblité de l'article</label>
                            <input class="form-control"  type="text" name="disponibility" placeholder="Quantité disponible *" value="<?php if(isset($_POST["disponibility"])) echo $_POST["disponibility"] ?>">   
                        <div class="help-block help" ></div>                    
                    </div>
<hr>
                    <div class="form-group">
                        <label>Prix</label>
                            <input class="form-control" type="text" name="price" placeholder="Prix de l'article *" value="<?php if(isset($_POST[" price "])) echo $_POST["price "] ?>">
                        <div class="help-block help" ></div>                    
                    </div>
<hr>  
                    <div class="form-group">
                        <label>Délais de livraison</label>                     
                            <input class="form-control" type="text" name="livraison" placeholder="Type de livraison et délais *" value="<?php if(isset($_POST["livraison"])) echo $_POST["livraison"] ?>">
                        <div class="help-block help" ></div>                    
                    </div>
<hr>
                    <div class="form-group">
                        <label>Tarif de la livraison</label>   
                            <input class="form-control" type="text" name="livraisonPrice" placeholder="Prix de la livraison *" value="<?php if(isset($_POST["livraisonPrice"])) echo $_POST["livraisonPrice"] ?>">        
                        <div class="help-block help" ></div>
                    </div>
<hr> 
                    <div class="form-group">
                        <label>Mode de réalisation</label>
                            <input class="form-control" type="text" name="realisation" placeholder="Type de réalisation (fait main, etc...) *" value="<?php if(isset($_POST["realisation"])) echo $_POST["realisation"] ?>">
                        <div class="help-block help" ></div>
                    </div>
<hr>
                    <div class="form-group">
                        <label>Lieu d'expédition</label>                     
                            <input class="form-control" type="text" name="country" placeholder="Provenance de l'article (France,etc...)*" value="<?php if(isset($_POST["country"])) echo $_POST["country"] ?>">
                        <div class="help-block help" ></div>
                    </div>
<hr>
                    <div class="form-group">
                        <label>Retours</label>          
                            <input class="form-control" type="text" name="retours" placeholder="Retours acceptés ou non (mettre les détails) *" value="<?php if(isset($_POST[" retours "])) echo $_POST["retours"] ?>">
                        <div class="help-block help" ></div>
                    </div>
<hr>
                    <div class="form-group">
                        <label>Description détaillée de l'article</label>
                            <textarea class="publication form-control" name="description" placeholder="Description de votre article *" style ='margin-top:-15px;'><?php if(isset($_POST["description"])) echo $_POST["description"] ?>
                            </textarea>
                        <div class="help-block help" ></div>
                    </div>
<hr>  
                        <input class="btn" type="submit" value="Mettre en vente">
                    
                    </form>
                </div> 
            </div> 
      

         
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>
