<?php
namespace Rossi56\controllers;

use \Rossi56\models\ArticlesManager;
use \Rossi56\models\CommentsManager;
use \Rossi56\models\BlogManager;
use \Rossi56\models\CaddieManager;
use \Rossi56\models\CategoryManager;
use \Rossi56\models\MembresManager;
use \Rossi56\models\MarketManager;

class ControllerBlog
{
    private $chapitre;
    private $commentaire;
    private $comment;
    public static $erreurs = [];
    private $nb_articles;
    private $compte;
    private $categories;
    
   

    public function __construct()
    {
        $this->chapitre = new BlogManager;
        $this->comment = new CommentsManager;
        $this->caddie = new CaddieManager;
        $this->membre = new MembresManager;
        $this->category = new CategoryManager;
    }

    /**
     * AFFICHAGE DU BLOG
     *
     * @return void
     */
    public function chapitres()
    {
        $chapitres = $this->chapitre->getChapitres();
        $categories = $this->category->getCategories();
        
        
        require ('views/allBlogView.php');
    }


  /**
     * AFFICHAGE DU BLOG MEMBRE
     *
     * @return void
     */
    public function chapitresMembre($id_membre)
    {
        $chapitres = $this->chapitre->getChapitres($id_membre);
        $nb_articles =  $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();
        
        
        
        require ('views/allBlogView.php');
    }

      /**
     * AFFICHAGE DES 5 derniers ARTICLES
     *
     * @return void
     */
    public function lastBlog()
    {
        $chapitres = $this->chapitre->getLastBlog();
        $commentaires = $this->comment->lastComments();
    }

  

 /**
     * Affiche le détail d'un seul article du blog en tant que membre
     *
     * @param [type] $id
     * @return void
     */
    public function chapitreMembre($id_chapitre, $id_membre) 
    {
      $chapitre = $this->chapitre->getChapitre($id_chapitre); 
      $commentaires = $this->chapitre->getCommentsBlog($id_chapitre);
      $nb_commentaires = $this->chapitre->getnbCommentsBlog($id_chapitre);
      $nb_articles = $this->caddie->getNbArticles($id_membre);
      $categories = $this->category->getCategories();
      
      require ('views/blogChapitreView.php');
    }

    /**
     * Affiche le détail d'un seul article du blog
     *
     * @param [type] $id
     * @return void
     */
    public function chapitre($id_chapitre) 
    {
      $chapitre = $this->chapitre->getChapitre($id_chapitre);
      $commentaires = $this->chapitre->getCommentsBlog($id_chapitre);
      $nb_commentaires = $this->chapitre->getnbCommentsBlog($id_chapitre);
      $categories = $this->category->getCategories();
      
      require ('views/blogChapitreView.php');
    }
 

   /**
     * Fonction pour poster des commentaires blog
     *
     * @param [type] $id_membre
     * @param [type] $id_chapitre
     * @param [type] $commentaire
     * @return void
     */
    public function postCommentBlog($id_membre, $id_chapitre, $commentaire)
    {
      if(!empty($commentaire))
      {
       
        $comment = $this->chapitre->commenterBlog($id_membre, $id_chapitre, $commentaire);
        array_push(self::$erreurs, '<h2>Votre Message a bien été envoyé !</h2>
        <i class="far fa-check-circle"></i>
         ');
       
      }
      else
      {
        
        array_push(self::$erreurs," <i class='fas fa-exclamation-triangle'></i> <br> Tous les champs sont obligatoires !" );
       
      }
      header('Location: Chapitre&id=' . $id_chapitre);
    }
    /**
     * Fonction de la barre de recherche
     *
     * @param [type] $query
     * @return void
     */
    public function search($query)
    {
        $articles = $this->article->recherche($query);
        require ('views/articlesView.php');
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
    
    
     /**
     * AFFICHAGE DE PLUSIEURS ARTICLES 
     *
     * @return void
     */
    public function getChapitresPage($start, $perPage, $id_membre)
    {
        if(isset($_POST['parPage']) && !empty($_POST['parPage']) && ctype_digit($_POST['parPage']) == 1)
        {
            $perPage = $_POST['parPage'];
        }
        else
        {
            $perPage = 4;
        }

        $total = $this->chapitre->getCount();
        $total = intval($total[0]);
        $perPage = intval($perPage);
        $nbPage = ceil($total/$perPage); 
        $categories = $this->category->getCategories();
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        

        
        if(isset($_GET['page']) && !empty($_GET['page']) && ctype_digit($_GET['page']) == 1)
        {
            if($_GET['page'] > $nbPage)
            {
                $current = $nbPage;     
            }
            else
            {
                $current = $_GET['page'];    
            }
        }
        else
        {
            $current = 1;
        }
        $start = ($current-1)*$perPage;
        $chapitres = $this->chapitre->getChapitresPage($start, $perPage);

        require ('views/allBlogView.php');
    }
}    