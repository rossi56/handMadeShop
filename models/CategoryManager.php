<?php
namespace Rossi56\models;
use \Rossi56\models\Model;




/**
 * Gestion des articles
 */
class CategoryManager extends Model
{

    /**
     * Requetes DE PLUSIEURS CATEGORIES
     *
     * @return void
     */
    public function getCategories()
    {
        $bdd = $this->getBdd();

        $req = $bdd->query("SELECT * FROM category ORDER BY 'name'");
        $res = $req->fetchAll();

        return $res;
    }

     /**
     * Requetes DE PLUSIEURS CATEGORIES
     *
     * @return void
     */
    public function getOneCategorie($id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT * FROM category WHERE id = ?");
        $req->execute([$id]);
        $res = $req->fetch();
    }

        /**
     * Requetes DE PLUSIEURS CATEGORIES
     *
     * @return void
     */
    public function getOneSubCategorie($id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT * FROM subcategory WHERE id = ?");
        $req->execute([$id]);
        $res = $req->fetch();
    }

     /**
     * Requetes DE PLUSIEURS CATEGORIES
     *
     * @return void
     */
    public function getSubCategories($id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT subcategory.*, category.* FROM subcategory inner join category on subcategory.id_category = category.id where id_category = ?");
        $req->execute([$id]);    
        $res = $req->fetchAll();
        return $res;
    }

     /**
     * Requetes DE PLUSIEURS SOUS_CATEGORIES D'ARTICLES
     *
     * @return void
     */
    public function getSubCatArticles($id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT subcategory.*, articles.* FROM articles INNER JOIN subcategory ON articles.id_subcategory = subcategory.id where articles.id_subcategory = ?");
        $req->execute([$id]);    
        $res = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }

         /**
     * Requetes DE PLUSIEURS SOUS_CATEGORIES D'ARTICLES
     *
     * @return void
     */
    public function getSubCatArticle($id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT subcategory.*, articles.* FROM articles INNER JOIN subcategory ON articles.id_subcategory = subcategory.id where articles.id = ?");
        $req->execute([$id]);    
        $res = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }

       /**
     * Requetes DE PLUSIEURS CATEGORIES D'ARTICLES
     *
     * @return void
     */
    public function getCatArticle($id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT articles.*, category.* FROM articles INNER JOIN category ON articles.id_category = category.id Where articles.id= ?");
        $req->execute([$id]);    
       
        $res = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }

    

        /**
     * AFFICHAGE D'UNE SEULE CATEGORIE
     *
     * @param [type] $id
     * @return void
     */
    public function getCategory($id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT * FROM category WHERE id = ?");
        $req->execute([$id]);
        $res = $req->fetch();

    }

          /**
     * AFFICHAGE D'UNE SEULE sous-CATEGORIE
     *
     * @param [type] $id
     * @return void
     */
    public function getSubCategory($id_sub)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT * FROM subcategory WHERE id = ?");
        $req->execute([$id_sub]);
        $res = $req->fetch();

    }

    public function getAllSubCategories()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query('SELECT * FROM subcategory ORDER BY id ASC ');
        $res = $req->fetchAll();
        
        return $res;
      
    }

  

   
     /**
     * Compte des categories
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