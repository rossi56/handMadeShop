<?php
require_once ('models/Model.php');

use Projet5\models;


/**
 * Gestion des articles
 */
class ArticlesManager extends Model
{

    
    public function addArticle($titre, $image1, $image2, $image3,  $category, $subCategory, $disponibility, $price, $livraison, $livraisonPrice, $realisation, $country, $retours, $description, $idMarket, $id_membre)
    {
        $bdd =$this->getBdd();
        $req = $bdd->prepare("INSERT INTO articles(titre, img, image1, image2, id_category, id_subCategory,  disponibility, price, livraison, livraisonPrice, realisation, country, retours, description, extrait, id_market, id_membre) VALUES(:titre, :img, :image1, :image2, :id_category, :id_subCategory, :disponibility, :price, :livraison, :livraisonPrice, :realisation, :country, :retours, :description, :extrait, :id_market, :id_membre)");
            $req->execute([
            "titre" => $titre,        
            "img" => $image1,
            "image1" => $image2,
            "image2" => $image3,
            "id_category" => $category,
            "id_subCategory" => $subCategory,
            "disponibility" => $disponibility,
            "price" => $price, 
            "livraison" => $livraison,
            "livraisonPrice" => $livraisonPrice,
            "realisation" => $realisation,
            "country" => $country,
            "retours" => $retours,
            "description"  => $description,
            "extrait" => substr($description, 0, 100),
            "id_market" => $idMarket,
            "id_membre" => $id_membre
            ]); 
    }



    /**
     * AFFICHAGE D'UN SEUL ARTICLE
     *
     * @param [type] $id
     * @return void
     */
    public function getArticle($id)
    {
        $bdd = $this->getBdd();

    /*Sécurisation id de l'url, faille de sécurité*/
    $req = $bdd->prepare("SELECT id, titre, extrait, description, img, price, DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, image1, image2, realisation, favoris, livraison, country, livraisonPrice, retours, disponibility, id_membre, id_market, id_category, id_subCategory FROM articles WHERE id = ?");
    $req->execute([$id]);
    $res = $req->fetch();
    return $res;
    }



    /**
     * Signaler commentaire
     *
     * @param [type] $id
     * @return void
     */
    public function reportComment($id)
    {
      $bdd =$this->getBdd();

      $req = $bdd->prepare('UPDATE commentaires SET report = (report + 1) WHERE id = ?');
      $req->execute([$id]);
    }

    /**
     * Ajouter aux favoris
     *
     * @param [type] $id
     * @return void
     */
    public function addFavoris($id)
    {
      $bdd =$this->getBdd();

      $req = $bdd->prepare('UPDATE articles SET favoris = (favoris + 1) WHERE id = ?');
      $req->execute([$id]);
    }

    /**
     * Fonction pour la barre de recherche
     *
     * @param [type] $query
     * @return void
     */
    public  function recherche($query)
    {
        $bdd =$this->getBdd();
        $req = $bdd->prepare("SELECT id, titre, extrait, description, img, price, DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, image1, image2, realisation, favoris, livraison, country, livraisonPrice, retours, disponibility, id_membre, id_market, id_category, id_subCategory FROM articles WHERE titre LIKE :query OR description LIKE :query ORDER BY id DESC");
        $req->execute([
            "query" => '%' . $query . '%' //il peut y avoir du contenu avant ou après le terme de recherche
        ]);
        $res = $req->fetchAll();
        return $res;
    }

   

    /**
     * Fonction commenter Article
     *
     * @param [type] $id_membre
     * @param [type] $id_article
     * @param [type] $commentaire
     * @return void
     */
    public function commenter($id_membre, $id_article, $commentaire ) {
        if(isset($_SESSION["membre"])) {
            $bdd =$this->getBdd();
        
            $erreur = "";
    
            extract($_POST);
    
            if(!empty($commentaire)) {
               $id_article = (int)$_GET["id"];//On vérifie l'intégrité de id_article
                $req = $bdd->prepare("INSERT INTO commentaires(id_membre, id_article, commentaire) VALUES(:id_membre, :id_article, :commentaire)");
                $req->execute([
                    "id_membre" => $_SESSION["membre"],
                    "id_article" => $id_article,
                    "commentaire" => nl2br(htmlentities($commentaire))
                    
                ]);
                }
            }   
        }

         /**
     * Affichage des 5 derniers articles publiés
     *
     * @return void
     */
    public function getLast5()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query("SELECT id, titre, extrait, description, img, price, DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, image1, image2, realisation, favoris, livraison, country, livraisonPrice, retours, disponibility, id_membre, id_market, id_category, id_subCategory FROM articles ORDER BY id ASC limit 0,4");
        $res = $req->fetchAll();

        return $res;
    }

    public function getArticles()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query("SELECT id, titre, extrait, description, img, price, DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, image1, image2, realisation, favoris, livraison, country, livraisonPrice, retours, disponibility, id_membre, id_market, id_category, id_subCategory FROM articles ORDER BY id DESC");
        $res = $req->fetchAll();

        return $res;
    }

    /**
     * Affichage des 5 derniers commentaires
     *
     * @return void
     */
    public function getLast5Comments()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query("SELECT  commentaires.commentaire, commentaires.id, DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, commentaires.id_membre, membres.pseudo, membres.avatar FROM commentaires INNER JOIN membres ON commentaires.id_membre = membres.id ORDER BY commentaires.id DESC limit 0,5");
        $res = $req->fetchAll();

        return $res;
    }


     /**
     * Affichage des 5 derniers commentaires
     *
     * @return void
     */
    // public function getLastArticles()
    // {
    //     $bdd = $this->getBdd();
        
    //     $req = $bdd->query("SELECT id, titre, extrait, description, img, price, DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, image1, image2, realisation, favoris, livraison, country, livraisonPrice, retours, disponibility, id_membre, id_market, id_category, id_subCategory FROM articles INNER JOIN membres ON articles.id = membre.id ORDER BY articles.id DESC limit 0,5");
    //     $res = $req->fetchAll(PDO::FETCH_ASSOC);

    //     return $res;
    // }


   /**
     * Fonction de gestion des articles compte utilisateur
     *
     * @return void
     */  
    public function articles_user()
    {
      $bdd =$this->getBdd();

        $req = $bdd->prepare("SELECT  articles.id, DATE_FORMAT (articles.publication, '%d/%m/%Y ') AS publication, articles.id_membre, articles.img, articles.description, articles.extrait, articles.titre, articles.price, membres.* FROM articles INNER JOIN membres ON articles.id_membre = membres.id AND articles.id_membre = ? ORDER BY articles.id DESC LIMIT 0,4 ");
        $req->execute([$_SESSION["membre"]]);
        $res = $req->fetchAll();
          
          return $res;
    }

    /**
     * AFFICHAGE DE PLUSIEURS ARTICLES
     *
     * @return void
     */
    public function getArticlesPage($start, $perPage)
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query("SELECT id, titre, extrait, description, img, price, DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, image1, image2, realisation, favoris, livraison, country, livraisonPrice, retours, disponibility, id_membre, id_market, id_category, id_subCategory FROM articles ORDER BY id DESC LIMIT ".$start.",".$perPage);
        $res = $req->fetchAll();
        return $res;
    }



    /**
     * Compte des articles
     *
     * @return void
     */
    public function getCount()
    {
        $bdd = $this->getBdd();
        $req = $bdd->query('SELECT COUNT(*) AS total FROM articles ');
        $res = $req->fetch();
        return $res;
    }
}