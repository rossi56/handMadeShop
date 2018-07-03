<?php
namespace Rossi56\models;
use \Rossi56\models\Model;


/**
 * Gestion des articles
 */
class CaddieManager extends Model
{

  public function getCaddieByArticle($id)
    {
      $bdd = $this->getBdd();

      $req = $bdd->prepare('SELECT * FROM caddie where id_article = ?');
      $req->execute([$id]);

      $res = $req->fetch();
      return $res;
    }

    /**
     * Fonction récupération articles caddie
     *
     * @return void
     */  
    public function getCaddie()
    {
      $bdd =$this->getBdd();
      
        $req = $bdd->prepare("SELECT caddie.*, articles.* FROM caddie INNER JOIN articles ON caddie.id_article = articles.id AND caddie.id_membre = ? ");
        $req->execute([$_SESSION["membre"]]);

        $res = $req->fetchAll(\PDO::FETCH_ASSOC);
          return $res;
    }

     /**
     * Ajouter un article au caddie
     *
     * @param [type] $image2
     * @param [type] $image
     * @param [type] $contenu
     * @param [type] $titre
     * @return void
     */
    public function addArticle($id, $id_membre, $price, $quantite)
    {
        $bdd =$this->getBdd();

        $req = $bdd->prepare("INSERT INTO caddie(id_article, id_membre, price, quantite, price_total) VALUES(:id_article, :id_membre, :price, :quantite, :price_total)");
            $req->execute([
           "id_article" => $id,
            "id_membre" => $_SESSION["membre"],
            "price" => $price,
            "quantite" => $quantite,
            "price_total" => round($price*$quantite,2)
            ]);    
    }
    
    /**
     * Fonction de gestion du nombre d'articles dans le caddie
     *
     * @param [type] $id_article
     * @return void
     */
    public function getNbArticles($id_membre) 
    {
      $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT sum(quantite) FROM caddie WHERE id_membre = ?");
        $req->execute([$id_membre]);
        $res = $req->fetch()[0];
          
        return $res;
    }

    public function getFacture($id_membre)
    {
      $bdd = $this->getBdd();

      $req = $bdd->prepare('SELECT * FROM paiements where id = ?');
      $req->execute([$id_membre]);

      $res = $req->fetch();
      return $res;
    }
   
    

     /**
     * fonction supression des articles du caddie
     *
     * @param [type] $id
     * @return void
     */
    public function supprimer($id)
    {
        $bdd =$this->getBdd();
        $req = $bdd->prepare("DELETE FROM caddie WHERE id_article = ?");
        $req->execute([$id]);
    }

    public function viderCaddie($id_membre)
    {
      $bdd =$this->getBdd();
      $req = $bdd->prepare("DELETE FROM caddie WHERE id_membre = ?");
      $req->execute([$id_membre]);
    }


    /**
     * Enlever un article depuis le tableau
     *
     * @param [type] $id
     * @return void
     */
    public function articlePlus($id)
    {
      $bdd =$this->getBdd();  
      $req = $bdd->prepare('UPDATE caddie SET quantite = (quantite + 1),  price_total = (price*quantite) WHERE id_article = ?');
      $req->execute([$id]);
    }

    /**
     * Enlever un article depuis le tableau
     *
     * @param [type] $id
     * @return void
     */
    public function articleMoins($id)
    {
      $bdd =$this->getBdd();

      $req = $bdd->prepare('UPDATE caddie SET quantite = (quantite - 1),  price_total = (price*quantite) WHERE id_article = ? ');
      $req->execute([$id]);
    } 


    public function totalPriceCaddie($id_membre)
    {
      $bdd =$this->getBdd();

      $req = $bdd->prepare("SELECT sum(price_total) FROM caddie WHERE id_membre = ?");
      $req->execute([$id_membre]);

      $res = $req->fetch()[0];
     
      return $res;
    }


}