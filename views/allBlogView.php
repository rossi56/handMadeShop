<?php ob_start() ?>
<h2>Bienvenue sur le Blog de "Ma p'tite Boutique"</h2>
<img class="logo" src="public/img/market/logo3.png" alt="logo">
<div class="all">

           
<?php    
    foreach($chapitres as $chapitre) ://boucle d'affichage des articles
?>
 <div class="card-deck">
        <div class="card">
            <img class="card-img-top" src="public/img/blog/<?= $chapitre["image_pres"]; ?>" alt=<?= $chapitre["image_pres"]; ?>>
                <div class="card-block">
                    <h4 class="card-title"><?= $chapitre["titre"] ?></h4>
                    <p class="card-text "><?= $chapitre["extrait"] ?></p>
                    <a  class="btn" href="Chapitre&id=<?= $chapitre["id"];  ?>">Lire la suite...</a>
                </div>
        </div>
    </div>
<?php
    endforeach;
?>
<div class="page">
    <form method="post">
        <label>Nombre d'articles par page:</label>
        <select name="parPage" >
<?php
    for($i = 1; $i <= 4; $i++):
?>
            <option value="<?= $i ?>"><?= $i ?></option>
<?php
    endfor;
?>
        </select>
        <input type="hidden" name='page' value='<?= $current;?>'>
        <button class="btn btn-xs" type='submit'>Appliquer</button>
    </form>
<nav aria-label="Page navigation example">
<ul class="pagination ">
        <li class='<?php if($current == '1'){ echo "disabled"; } ?> page-item'><a class="page-link" href="Blog&page=<?php if($current != '1')
        {
             echo $current-1; 
        }
        else
        { 
            echo $current; 
        } ?>">&laquo;</a>
        </li> <!-- mettre une ternaire -->
<?php
    for($i = 1; $i <= $nbPage; $i++):
        if($i == $current):
?>
        <li class="active page-item"><a class="page-link" href="Blog&page=<?= $i ?>"><?= $i ?></a></li>
<?php
    else:
?>
        <li  class="page-item"><a class="page-link" href="Blog&page=<?= $i ?>"><?= $i ?></a></li>        
<?php
    endif;
    endfor;
?>

        <li class='<?php if($current == $nbPage){ echo "disabled"; } ?> page-item'><a class="page-link" href="Blog&page=<?php if($current != $nbPage)
        {
             echo $current-1; 
        }
        else
        { 
            echo $current; 
        } ?>">&raquo;</a>
        </li> <!-- mettre une ternaire -->
    </ul> 
</nav>        
</div> 
</div>
<?php $content = ob_get_clean(); ?>
<?php require('templates/template.php'); ?>

