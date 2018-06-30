<?php ob_start() ?>
    <h2>Articles en vente sur "Hand made shop"</h2>
    <img class="logo" src="public/img/market/logo3.png" alt="logo">
        <div class="all">
  
<?php
    if(count($articles) > 0) :
    if(isset($_POST["query"])) : //affichage du résultat de recherche s'il y a un résultat
?>

    <h3 class="recherche">Voici le résultat de votre recherche avec "<?= $_POST["query"] ?>"</h3>

<?php
    endif;             
    foreach($articles as $article) ://boucle d'affichage des articles
?>

            <div class="card-deck ">
                <div class="card">
                    <img class="card-img-top" src="public/img/article/<?= $article["img"]; ?>" alt=<?= $article["img"]; ?>>
                    <div class="card-block">
                        <h4 class="card-title"><?= $article["titre"]; ?></h4>
                            <p class="card-text"><?= $article["extrait"]; ?> </p>
                            <p class="price"><span>Prix:</span> <?= $article["price"]; ?> euros</p> 
                    <a  class="btn" href="Article&id=<?= $article["id"];  ?>">Découvrir...</a>
                    </div>    
                </div>
            </div>

<?php
    endforeach;
    else :
?>
                            <p class="recherche">Aucun résultat pour votre recherche</p>

<?php
    endif;
?>
            <div class="page">
                <form method="post">
                    <label>Nombre d'articles par page:</label>
                    <select name="parPage" >

<?php
    for($i = 1; $i <= 10; $i++):
?>
            <option value="<?= $i ?>"><?= $i ?></option>
<?php
    endfor;
?>
                    </select>
                <input type="hidden" name='page' value='<?= $current ?>'>
                    <button class="btn btn-xs" type='submit'>Appliquer</button>
                </form>

            <nav aria-label="Page navigation example">
                <ul class="pagination ">
                    <li class='<?php if($current == '1'){ echo "disabled"; } ?> page-item'><a class="page-link" href="Articles&page=<?php if($current != '1')
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
                    <li class="active page-item"><a class="page-link" href="Articles&page=<?= $i ?>"><?= $i ?></a></li>

<?php
    else:
?>

                    <li  class="page-item"><a class="page-link" href="Articles&page=<?= $i ?>"><?= $i ?></a></li>        
<?php
    endif;
    endfor;
?>

                    <li class='<?php if($current == $nbPage){ echo "disabled"; } ?> page-item'><a class="page-link" href="Articles&page=<?php if($current != $nbPage)
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