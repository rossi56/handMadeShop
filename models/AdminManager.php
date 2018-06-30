<?php

namespace Rossi56\models;

use \Rossi56\models\Model;



/**
 * Gestion de la partie administration
 */
class AdminManager extends Model
{

       /**
     * fonction publier un article (administrateur)
     *
     * @param [type] $image2
     * @param [type] $image
     * @param [type] $description
     * @param [type] $titre
     * @return void
     */
    public function poster( $image, $image1, $image2, $image3, $image4, $description, $titre)
    {
        $bdd =$this->getBdd();
        $poster = $bdd->prepare("INSERT INTO blog(titre, extrait, description, image_pres, image_art, image1, image2, image3) VALUES(:titre, :extrait, :description, :image_pres, :image_art, :image1, :image2, :image3)");
            $poster->execute([
            "titre" => $titre,
            "extrait" => substr($description, 0, 200),//récupération de l'extrait de 200 caractères
            "description" => nl2br($description),
            "image_pres" => $image,
            "image_art" => $image1,
            "image1" => $image2,
            "image2" => $image3,
            "image3" => $image4,
            ]);
        
    }

    
    /**
     * Anciens Chapitres publiés
     *
     * @return void
     */
    public function getChapitres()
    {
        $bdd =$this->getBdd();

        $req =$bdd->query("SELECT * FROM blog ORDER BY id DESC");
        $res = $req->fetchAll();
        return $res;
    }


    /**
     * fonction supression d'un chapitre
     *
     * @param [type] $id
     * @return void
     */
    public function deleteChapitre($id){
        $bdd =$this->getBdd();


        // $image = $bdd->prepare("SELECT img, imageArt FROM articles WHERE id = ?"); //SUPPRESSION IMAGE DANS LE DOSSIER IMG
        // $image->execute([$id]);
        // $image = $image->fetch()["img"]["imageArt"];

        // unlink("../img/" . $image);

        $req = $bdd->prepare("DELETE FROM blog WHERE id = ?");
        $req->execute([$id]);
    }

     /**
     * fonction supression d'un article
     *
     * @param [type] $id
     * @return void
     */
    public function deleteArticle($id){
        $bdd =$this->getBdd();


        // $image = $bdd->prepare("SELECT img, imageArt FROM articles WHERE id = ?"); //SUPPRESSION IMAGE DANS LE DOSSIER IMG
        // $image->execute([$id]);
        // $image = $image->fetch()["img"]["imageArt"];

        // unlink("../img/" . $image);

        $req = $bdd->prepare("DELETE FROM articles WHERE id = ?");
        $req->execute([$id]);
    }


    /**
     * Affichage des anciens chapitres
     *
     * @return void
     */
    public function getChapitre($id){
        $bdd =$this->getBdd();
       
        $req = $bdd->prepare("SELECT * FROM blog WHERE id = ?");
        $req->execute([$id]);
        $res = $req->fetch();

        return $res;
    }

      /**
     * Fonction modification des chapitres
     *
     * @return void
     */
    public function editerArt($id, $titre, $description)
    {
        $bdd =$this->getBdd();
       
        
        $req = $bdd->prepare("UPDATE articles SET titre = :titre, extrait = :extrait, description = :description WHERE id = :id");
        $req->execute([
            "titre" => $titre,
            "extrait" => substr($description, 0, 200),//récupération de l'extrait de 200 caractères
            "description" => nl2br($description),
            "id" => $id
          
        ]);   
    }

       /**
     * Fonction modification des articles
     *
     * @return void
     */
    public function editer($id, $titre, $description)
    {
        $bdd =$this->getBdd();
       
        
        $req = $bdd->prepare("UPDATE blog SET titre = :titre, extrait = :extrait, description = :description WHERE id = :id");
        $req->execute([
            "titre" => $titre,
            "extrait" => substr($description, 0, 200),//récupération de l'extrait de 200 caractères
            "description" => nl2br($description),
            "id" => $id
        ]);    
    }

        /**
         * Supression d'un membre
         *
         * @return void
         */
        public function eraseMember($id)
        {
            $bdd = $this->getBdd();
            
            // $id = (int)$_GET['id'];
            $req = $bdd->prepare('DELETE FROM membres WHERE id = ?');
            $req->execute([$id]);

            return $req;
        }


        /**
         * Supression d'un commentaire
         *
         * @param [type] $id
         * @return void
         */
        public function eraseComment($id)
        {
            $bdd = $this->getBdd();

            $req = $bdd->prepare('DELETE FROM commentaires WHERE id = ?');
            $req->execute([$id]);

            return $req;
        }

        /**
         * Supression d'un commentaire
         *
         * @param [type] $id
         * @return void
         */
        public function eraseComments($idPost)
        {
            $bdd = $this->getBdd();

            $req = $bdd->prepare('DELETE FROM commentaires WHERE id_article = ?');
            $req->execute([$idPost]);

            return $req;
        }

}