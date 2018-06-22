<?php

use Projet5\controllers;


/**
 * Contrôleur Chapitre
 */
class ControllerOneArticle
{

  private $article;
  private $commentaire;
  private $nb_commentaires;
  private $nb_articles;
  private $comment;
  private $search;
  private $caddie;
  private $compte;
  private $categories;
  private $markets;
  private $catArt;
  private $subCatArt;
  private $subCategories;
  private static $erreurs = [];
  private static $vendor;

    
    public function __construct() 
    {
      $this->article = new ArticlesManager;
      $this->comments = new CommentsManager;
      $this->caddie = new CaddieManager;
      $this->category = new CategoryManager;
      $this->membre = new MembresManager;
      $this->market = new MarketManager;
      
    }


     /**
     * Ajouter aux favoris
     *
     * @return void
     */
    public function addFavoris($id)
    {
        $articles = $this->article->addFavoris($id);
        
    }

    /**
     * Affiche le détail d'un seul article Membre
     *
     * @param [type] $id
     * @return void
     */
    public function article($id, $id_membre) 
    {
      $article = $this->article->getArticle($id);
      $compte = $this->membre->infos($id);
      $commentaires = $this->comments->getCommentsArticle($id);
      $nb_commentaires= $this->comments->getnbComments($id);
      $nb_articles = $this->caddie->getNbArticles($id_membre);
      // $categorie = $this->category->getOneCategorie($id);
      $categories = $this->category->getCategories();
      $subCatArt = $this->category->getSubCatArticle($id);
      $market = $this->market->getOneMarketMembre($id_membre);
      self::$vendor = $this->membre->getVendor($id);
      $categorie = $this->category->getCatArticle($id);
      require ('views/articleView.php');
    }


    
  



    /**
     * Fonction pour poster des commentaires
     *
     * @param [type] $id_membre
     * @param [type] $id_article
     * @param [type] $commentaire
     * @return void
     */
    public function postComment($id_membre, $id_article, $commentaire)
    {
      if(!empty($commentaire))
      {
       
        $comment = $this->article->commenter($id_membre, $id_article, $commentaire);
        array_push(self::$erreurs, '<h2>Votre Message a bien été envoyé !</h2>
        <i class="far fa-check-circle"></i>
         ');
       
      }
      else
      {
        
        array_push(self::$erreurs," <i class='fas fa-exclamation-triangle'></i> <br> Tous les champs sont obligatoires !" );
       
      }
      header('Location: Article&id=' . $id_article);
    }


    /**
     * Signalement d'un commentaire
     *
     * @param [type] $id
     * @param [type] $id_article
     * @return void
     */
    public function reportComment($id, $id_article)
    {
      $commentaire = $this->article->reportComment($id);
      header("Location: Article&id=" . $id_article);
     
    }

    public static function getVendor()
    {
        return self::$vendor;
        
    }

    /**
     * Fonction recherche barre de recherche
     *
     * @param [type] $query
     * @return void
     */
    public function search($query)
    {
        $search = $this->article->recherche($query);
        require('views/articlesView.php');
    } 

      /**
     * Fonction de récupération des erreurs de formulaires
     *
     * @return void
     */
    public static function getErreur()
    {
        return self::$erreurs;
    }
}