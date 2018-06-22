<!-- <nav>
    <a class="line" href="Accueil">Ma p'tite boutique</a>
    <form class="query" method="post" action="Recherche">
        <input class="search" type="search" name="query" placeholder="Trouvez..." value="<?php if(isset($_POST[" query
                        "])) echo $_POST["query "]//laisser champs de recherche rempli ?>">
    </form>
<?php
    if(isset($_SESSION["membre"])) :
    if($nb_articles != null):
?>

        <a href="Compte-utilisateur">Votre caddie<i class="fas fa-shopping-cart"></i><span class="badge badge-default"><?= $nb_articles ?></span</a>
<?php
    else :
?>
        <a href="Compte-utilisateur">Votre caddie<i class="fas fa-shopping-cart"></i><span class="badge badge-default"><?= $nb_articles = 0 ?></span</a>
<?php
    endif;
?>
        <a class="line profil" href="Compte-utilisateur">Espace Personnel</a>
        <a class="line" href="Deconnexion">Deconnexion</a>
        
<?php
    else :
?>
        <a class="line connect" href="Page-de-connexion">Se connecter</a>
        <a class="line" href="Inscription">S'inscrire</a>

        <a class="hvr-underline-from-center" href="Administration">Administration</a>


<?php
    endif;
?>
   
</nav> -->