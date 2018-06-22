<?php
require_once 'models/BlogManager.php';
require_once 'models/CategoryManager.php';



class ControllerArticles
{
    private $articles;
    private $nb_articles;
    private $compte;
    private $market;
    private $subCategories;
    private $categories;
    private static $erreurs = [];
    private $perPage;
    private $nbPage; 
    private $start;
    private $total;
    private $current;

    
   

    public function __construct()
    {
        $this->article = new ArticlesManager;
        $this->search = new ArticlesManager;
        $this->comment = new CommentsManager;
        $this->chapitre = new BlogManager;
        $this->caddie = new CaddieManager;
        $this->compte = new MembresManager;
        $this->market = new MarketManager;
        $this->category = new CategoryManager;
    }

    /**
     * AFFICHAGE DE PLUSIEURS ARTICLES Membre
     *
     * @return void
     */
    public function getArticlesMembre($id_membre)
    {
        $articles = $this->article->getArticles();
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();
        
        require ('views/ArticlesView.php');
    }

     /**
     * AFFICHAGE DE PLUSIEURS ARTICLES 
     *
     * @return void
     */
    public function getArticlesPage($start, $perPage, $id_membre)
    {
        if(isset($_POST['parPage']) && !empty($_POST['parPage']) && ctype_digit($_POST['parPage']) == 1)
        {
            $perPage = $_POST['parPage'];
        }
        else
        {
            $perPage = 10;
        }

        $total = $this->article->getCount();
      

        $total = $total[0];
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
        $articles = $this->article->getArticlesPage($start, $perPage);
        
        require ('views/allArticlesView.php');
    }



      /**
     * AFFICHAGE DE L'accueil membre
     *
     * @return void
     */
    public function accueilMembre($id_membre)
    {
        $articles = $this->article->getLast5();
        $commentaires = $this->comment->lastComments();
        $chapitres = $this->chapitre->getLastBlog();
        $compte = $this->compte->infos($id_membre);
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();
        
        
        require ('views/accueilView.php');
    }

     /**
     * AFFICHAGE DE L'accueil
     *
     * @return void
     */
    public function accueil()
    {
        $articles = $this->article->getLast5();
        $commentaires = $this->comment->lastComments();
        $chapitres = $this->chapitre->getLastBlog();
        $categories = $this->category->getCategories();
               
        require ('views/accueilView.php');
    }

   

   /**
    * Création d'un article de la boutique
    *
    * @param [type] $titre
    * @param [type] $image1
    * @param [type] $image2
    * @param [type] $image3
    * @param [type] $categorie
    * @param [type] $subCategorie
    * @param [type] $disponibility
    * @param [type] $price
    * @param [type] $livraison
    * @param [type] $livraisonPrice
    * @param [type] $realisation
    * @param [type] $country
    * @param [type] $retours
    * @param [type] $description
    * @return void
    */
    public function addArticle($titre, $image1, $image2, $image3, $id_category, $id_subCategory,  $disponibility, $price, $livraison, $livraisonPrice, $realisation, $country, $retours, $description,  $idMarket, $id_membre)
    {

        $post = $this->article->addArticle($titre, $image1, $image2, $image3, $id_category, $id_subCategory,  $disponibility, $price, $livraison, $livraisonPrice, $realisation, $country, $retours, $description,  $idMarket, $id_membre);
        extract($_POST);

        $validation = true;

        if(empty($titre) || empty($id_category) || empty($id_subCategory)  || empty($disponibility) || empty($price) || empty($livraison) || empty($livraisonPrice) || empty($realisation) || empty($country) || empty($retours) || empty($description)) {
            $validation = false;
        }

        if(!isset($_FILES["file1"]) OR $_FILES["file1"]["error"] > 0) {
            $validation = false;
        }

        if(!isset($_FILES["file2"]) OR $_FILES["file2"]["error"] > 0) {
            $validation = false;

        }
        if(!isset($_FILES["file3"]) OR $_FILES["file3"]["error"] > 0) { 
            $validation = false;

        }
        if($validation) 
        {
            array_push(self::$erreurs, '<h2>Votre article a bien été créé !</h2>
            <i class="far fa-check-circle"></i>
             ');
            //Récupération de l'image
            $image1 = basename($_FILES["file1"]["name"]);
            $image2 = basename($_FILES["file2"]["name"]);
            $image3 = basename($_FILES["file3"]["name"]);
            
            //enregistrement définitif du fichier
            move_uploaded_file($_FILES["file1"]["tmp_name"], 'public/img/article' . $image1);
            move_uploaded_file($_FILES["file2"]["tmp_name"], 'public/img/article' . $image2);
            move_uploaded_file($_FILES["file3"]["tmp_name"], 'public/img/article' . $image3);
            

           
            
            unset($_POST["titre"]);
            unset($_POST["contenu"]);
        }
        
        header ('Location: Compte-utilisateur');


    }

    public function getPage($id, $id_membre)
    {
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $market = $this->market->getOneMarket($id);
        $categories = $this->category->getCategories();
        $subCategories = $this->category->getAllSubCategories();

        require ('views/createArticleView.php');

    }
    /**
     * Récupération du tableau d'erreur
     *
     * @return void
     */
    public static function getErreur()
    {
        return self::$erreurs;
    }



    /**
     * Fonction de la barre de recherche
     *
     * @param [type] $query
     * @return void
     */
    public function search($query, $id_membre)
    {
        $articles = $this->article->recherche($query);
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();

        require ('views/queryView.php');
    } 
    
    
}    