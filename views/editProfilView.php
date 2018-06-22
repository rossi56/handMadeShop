<?php ob_start();
$user = ControllerMembres::getUser()
?>
<h2>Edition de mes informations personnelles</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
            
            <div class="formulaire">
            <div class="wrapper">
            
                    <form  class="form-signin " action="" method="post" enctype='multipart/form-data'>

                        <label>Votre Pseudo: <?= $user ['pseudo']  ?></label>
                            <input class="form-control" type="text" name="newPseudo" placeholder="Nouveau Pseudo" value="">
<hr>  
                        <label>Votre E-Mail: <?= $user['email'] ?></label>
                            <input class="form-control" type="mail" name="newMail" placeholder="Nouvel e-mail" value="">
<hr>  
                        <label>Facturation: <?= $user['adressFacture'] ?> </label>
                            <input class="form-control" type="text" name="newAdressFacture" placeholder="Entrez votre adresse complète">
<hr>   
                        <label>Livraison: <?= $user['adressLivraison'] ?> </label>
                            <input class="form-control" type="text" name="newAdressLivraison" placeholder="Entrez votre adresse complète">
<hr>  
                        <label>Entrez un nouveau mot de passe: </label>
                            <input class="form-control" type="password" name="newPassword" placeholder="Nouveau Mot de passe">
<hr>  
                        <label>Confirmation du mot de passe:</label>
                            <input class="form-control" type="password" name="newPasswordConf" placeholder="Confirmation du Mot de passe">
<hr>  
                        <label>Avatar: <img src="public/img/avatars/<?= $user['avatar'] ?>" alt="<?= $user['avatar'] ?>"></label>
                            <input class="form-control" type="file" name='avatar'>
<hr>  
                            <button class='btn' type="submit" value="Mettre à jour">Soumettre</button>
                    
                    </form>
                    <?php if(isset($erreur)) { echo $erreur;} ?>
            </div>


        <?php $content = ob_get_clean(); ?>
        <?php require('templates/template.php'); ?>

 
