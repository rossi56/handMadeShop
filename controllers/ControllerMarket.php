<?php
namespace Rossi56\controllers;

use \Rossi56\models\ArticlesManager;
use \Rossi56\models\CommentsManager;
use \Rossi56\models\BlogManager;
use \Rossi56\models\CaddieManager;
use \Rossi56\models\CategoryManager;
use \Rossi56\models\MembresManager;
use \Rossi56\models\MarketManager;


use Projet5\controllers;


class ControllerMarket
{
    private $articles;
    private $nb_articles;
    private $market;
    private $create;
    private static $erreurs = [];
    
   

    public function __construct()
    {
        $this->market = new MarketManager;
        $this->article = new ArticlesManager;
        $this->caddie = new CaddieManager;
        $this->category = new CategoryManager;
      
    }



    /**
     * Supprimer une boutique
     *
     * 
     * @return void
     */
    public function deleteMarket($id)
    {
        $delete= $this->market->deleteMarket($id);
        $categories = $this->category->getCategories();
        
        header('Location: Compte-utilisateur');
        
    }

     /**
     * Infos Boutique unique
     *
     * @param [type] $id_market
     * @return void
     */
    public function getOneMarketMembre($id_membre)
    {
        $market = $this->market->getOneMarketMembre($id_membre);
        $articles = $this->market->getArticlesMarket();
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        
        require ('views/marketView.php');
        
    }

    public function getOneMarket($id, $id_membre)
    {
        $market = $this->market->getOneMarket($id);
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        // $market = $this->market->getOneMarketMembre($id_membre);
        $articles = $this->market->getArticlesMarket($id);
        $categories = $this->category->getCategories();
        require ('views/marketView.php');
    }


    /**
     * Supprimer un article de la boutique perso
     *
     * @param [type] $id
     * @return void
     */
    public function deleteArtMarket($id)
    {
        $articles = $this->market->deleteArtMarket($id);
        require ('views/marketView.php');
    }
    
     /**
     * Fonction de création de la boutique
     *
     * @param [type] $image
     * @param [type] $description
     * @param [type] $titre
     * @return void
     */
    public function create($image, $description, $name, $id_membre)
    {
        $create = $this->market->create($image, $description, $name, $id_membre);
        
        extract($_POST);

        $validation = true;

        if(empty($name) || empty($description)) {//Vérif de présence de contenu et d'un titre
            $validation = false;
            array_push(self::$erreurs, " <i class='fas fa-exclamation-triangle'></i> <br> Tous les champs sont obligatoires !");
        }

        if(!isset($_FILES["file"]) OR $_FILES["file"]["error"] > 0) {//Vérif de la présence d'image
            $validation = false;
            array_push(self::$erreurs, " <i class='fas fa-exclamation-triangle'></i> <br> Aucune photo de présentation sélectionnée!");
        }

           
        if($validation) 
        {
            array_push(self::$erreurs, '<h2>Votre boutique a bien été ouverte !</h2>
            <i class="far fa-check-circle"></i>
             ');
            //Récupération de l'image
            $image = basename($_FILES["file"]["name"]);
            //enregistrement définitif du fichier
            move_uploaded_file($_FILES["file"]["tmp_name"], 'public/img/article' . $image);

           
            unset($_POST["marketName"]);
            unset($_POST["description"]);
        }
        header ('Location: Compte-utilisateur');

    }

    public function getPage($id_membre)
    {
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();

        require ('views/newMarketView.php');

    }


    public function visitMarket($id_membre)
    {
        $markets = $this->market->getOneMarketMembre($id_membre);
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();

        require('views/boutiquesView.php');

    }

    public function visitMarketArt($id, $id_membre)
    {
        $markets = $this->market->getOneMarket($id);
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();
        $articles = $this->market->getArticlesMarket($id);


        require('views/marketArtView.php');

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
}    