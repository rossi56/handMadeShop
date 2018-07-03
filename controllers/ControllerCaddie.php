<?php
namespace Rossi56\controllers;

use \Rossi56\models\ArticlesManager;
use \Rossi56\models\CommentsManager;
use \Rossi56\models\BlogManager;
use \Rossi56\models\CaddieManager;
use \Rossi56\models\CategoryManager;
use \Rossi56\models\MembresManager;
use \Rossi56\models\MarketManager;



/**
 * Contrôleur Caddie
 */
class ControllerCaddie
{
    
    private $nb_articles;
    private $article;
    

    
    public function __construct()
    {
        $this->caddie = new CaddieManager;
        $this->membre = new MembresManager;
        $this->category = new CategoryManager;
    }
    

    /**
     * Récupération de la quantité d'articles dans le caddie
     *
     * @param [type] $id_membre
     * @return void
     */
    public function getNbArticles($id_membre)
    {
        $nb_articles = $this->caddie->getNbArticles($id_membre);

    }

    public function totalPriceCaddie($id_membre)
    {
        $count = $this->caddie->totalPriceCaddie($id_membre);
    }
  

   /**
     * Ajouter article dans le caddie
     *
     * @param [type] $id_membre
     * @return void
     */
    public function addArticle($id, $id_membre, $price, $quantite) 
    {
      $article = $this->caddie->addArticle($id, $id_membre, $price, $quantite); 
      header("Location: Compte-utilisateur");
    }

     /**
     * Ajouter article dans le caddie
     *
     * @param [type] $id_membre
     * @return void
     */
    public function articlePlus($id) 
    {
      $article = $this->caddie->articlePlus($id);

      header("Location: Compte-utilisateur");
       
    }


      /**
     * Fonction supression d'un chapitre et de ses commentaires
     *
     * @return void
     */
    public function deleteArticleCaddie($id)
    {
        $delete = $this->caddie->supprimer($id);
       header('location: Compte-utilisateur');    
    }

    /**
     * retirer article du caddie
     *
     * @param [type] $id_membre
     * @return void
     */
    public function articleMoins($id) 
    {
        $article = $this->caddie->getCaddieByArticle($id);
        if($article['quantite'] == '1'){

           
             $this->caddie->supprimer($id);
        }
        else
        { $article = $this->caddie->articleMoins($id);

    }
      header("Location: Compte-utilisateur");
           
    }
    
    public function getFacture($id_membre)
    {
        $facture = $this->caddie->getFacture($id_membre);
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();
        require('views/factureView.php');
    }
    
    
}