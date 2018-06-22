<?php
require_once ('models/Model.php');

use Projet5\models;


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

        $req = $bdd->prepare("SELECT * FROM subCategory WHERE id = ?");
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

        $req = $bdd->prepare("SELECT subCategory.*, category.* FROM subCategory inner join category on subCategory.id_category = category.id where id_category = ?");
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

        $req = $bdd->prepare("SELECT subCategory.*, articles.* FROM articles INNER JOIN subCategory ON articles.id_subCategory = subCategory.id where articles.id_subCategory = ?");
        $req->execute([$id]);    
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
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

        $req = $bdd->prepare("SELECT subCategory.*, articles.* FROM articles INNER JOIN subCategory ON articles.id_subCategory = subCategory.id where articles.id = ?");
        $req->execute([$id]);    
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
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
       
        $res = $req->fetchAll(PDO::FETCH_ASSOC);
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

        $req = $bdd->prepare("SELECT * FROM subCategory WHERE id = ?");
        $req->execute([$id_sub]);
        $res = $req->fetch();

    }

    public function getAllSubCategories()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query('SELECT * FROM subCategory ORDER BY id ASC ');
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