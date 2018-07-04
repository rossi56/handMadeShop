<?php
namespace Rossi56\models;
use \Rossi56\models\Model;



/**
 * Gestion des articles
 */
class MarketManager extends Model
{

    /**
     * AFFICHAGE DEs ARTICLES DE LA BOUTIQUE
     *
     * @return void
     */
    public function getArticlesMarket($id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT articles.*, market.id  FROM articles INNER JOIN market ON articles.id_market = market.id  where id_market = ?  ORDER BY articles.id DESC ");
        $req->execute([$id]);
        $res = $req->fetchAll();
        return $res;
    }


 

    /**
     * AFFICHAGE D'UNE BOUTIQUE
     *
     * @param [type] $id
     * @return void
     */
    public function getOneMarketMembre($id)
    {
    $bdd = $this->getBdd();

    /*Sécurisation id de l'url, faille de sécurité*/
    $req = $bdd->prepare("SELECT market.*, membres.* FROM market INNER JOIN membres ON market.id_membre = membres.id  where id_membre = ? ORDER BY market.id DESC ");
    $req->execute([$id]);
    $res = $req->fetchAll();
    return $res;
    }

 /**
     * AFFICHAGE D'UNE BOUTIQUE
     *
     * @param [type] $id
     * @return void
     */
    public function getOneMarket($id)
    {
    $bdd = $this->getBdd();

    /*Sécurisation id de l'url, faille de sécurité*/
    $req = $bdd->prepare("SELECT * FROM market WHERE id = ?");
    $req->execute([$id]);
    $res = $req->fetchAll(\PDO::FETCH_ASSOC);
    
    return $res;
    }


    /**
     *Supression d'un article d'une boutique perso
     *
     * @param [type] $id
     * @return void
     */
    public function deleteArtMarket($id){
        $bdd =$this->getBdd();

        $req = $bdd->prepare("DELETE FROM articles WHERE id = ?");
        $req->execute([$id]);
    }

     /**
     *Supression d'une boutique
     *
     * @param [type] $id
     * @return void
     */
    public function deleteMarket($id){
        $bdd =$this->getBdd();

        $req = $bdd->prepare("DELETE FROM market WHERE id = ?");
        $req->execute([$id]);
    }

   
    /**
     * Ouverture de la boutique
     *
     * @param [type] $image
     * @param [type] $description
     * @param [type] $name
     * @return void
     */
    public function create($image, $description, $name, $id_membre)
    {
        $bdd =$this->getBdd();
        $req = $bdd->prepare("INSERT INTO market(marketName, marketDescription, imgPres, id_membre) VALUES(:marketName, :marketDescription, :imgPres, :id_membre)");
            $req->execute([
            "marketName" => $name,
            "marketDescription" => nl2br($description),
            "imgPres" => 'logo3.png',
            "id_membre" => $id_membre
            ]);
        
    }
    /**
     * Récupération de la liste des boutiques dans l'espace admin
     *
     * @return void
     */
    public function getBoutiques()
    {
        $bdd =$this->getBdd();
        $req = $bdd->query("SELECT id, marketDescription, imgPres, id_membre, marketName, DATE_FORMAT (creation, '%d/%m/%Y ') AS creation FROM market ORDER BY id DESC");
        $res = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $res;
    }

    public function getVendeur($id)
    {
        $bdd = $this->getBdd();
        $req = $bdd->prepare("SELECT market.*, membres.* FROM market INNER JOIN membres ON market.id_membre = membres.id WHERE membres.id = ?");
        $req->execute([$id]);
       
    }
}