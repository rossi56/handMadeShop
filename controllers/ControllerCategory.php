<?php
namespace Rossi56\controllers;

use \Rossi56\models\ArticlesManager;
use \Rossi56\models\CommentsManager;
use \Rossi56\models\BlogManager;
use \Rossi56\models\CaddieManager;
use \Rossi56\models\CategoryManager;
use \Rossi56\models\MembresManager;
use \Rossi56\models\MarketManager;



class ControllerCategory
{
    private $categories;
    private $categorie;
    private $articles;
    private $nb_articles;
    private $perPage;
    private $nbPage; 
    private $start;
    private $total;
    private $current;
    private $subCategories;
    
   

    public function __construct()
    {
        $this->category = new CategoryManager;
        $this->caddie = new CaddieManager;
        $this->article = new ArticlesManager;
    }

   

    public function getSubCatArticles($id, $id_membre)
    {
        $categories = $this->category->getCategories();
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $subCategories = $this->category->getSubCatArticles($id);
        require ('views/subCatArticlesView.php');

    }

     /**
     * AFFICHAGE DE PLUSIEURS CATEGORIES 
     *
     * @return void
     */
    public function getCategoriesMembre($id_membre)
    {
        $categories = $this->category->getCategories();
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        require ('views/headerView.php');
    }

     /**
     * AFFICHAGE DE PLUSIEURS CATEGORIES Membres
     *
     * @return void
     */
    public function getCategories($id_membre)
    {
        $categories = $this->category->getCategories();
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        require ('views/categoryView.php');

    }

    public function getOneCategorie($id_sub, $id_membre)
    {
        $categories = $this->category->getCategories();
        $subCategories = $this->category->getSubCategories($id_sub);
        $nb_articles = $this->caddie->getNbArticles($id_membre);

        require ('views/subCategoryView.php');

    }



   

 
    
     
}
