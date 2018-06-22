<?php
require_once ('models/Model.php');

/**
 * Gestion des articles
 */
class BlogManager extends Model
{



    /**
     * AFFICHAGE D'UN SEUL ARTICLE
     *
     * @param [type] $id
     * @return void
     */
    public function getChapitre($id)
    {
        $bdd = $this->getBdd();

    /*Sécurisation id de l'url, faille de sécurité*/
    $req = $bdd->prepare("SELECT id, titre, description,  DATE_FORMAT(publication, '%d/%m/%Y ') AS publication, image_pres, image_art, image1, image2, image3 FROM blog WHERE id = ?");
    $req->execute([$id]);
    $res = $req->fetch();
   
    return $res;
    }

    /**
     * Signaler commentaire
     *
     * @param [type] $id
     * @return void
     */
    public function reportComment($id)
    {
      $bdd =$this->getBdd();

      $req = $bdd->prepare('UPDATE commentaires SET report = (report + 1) WHERE id = ?');
      $req->execute([$id]);
    }

   

 

   

    /**
     * Fonction commenter Article
     *
     * @param [type] $id_membre
     * @param [type] $id_chapitre
     * @param [type] $commentaire
     * @return void
     */
    public function commenterBlog($id_membre, $id_chapitre, $commentaire ) {
        if(isset($_SESSION["membre"])) {
            $bdd =$this->getBdd();
        
            $erreur = "";
    
            extract($_POST);
    
            if(!empty($commentaire)) {
               $id_chapitre = (int)$_GET["id"];//On vérifie l'intégrité de id_article
                $req = $bdd->prepare("INSERT INTO commentaires(id_membre, id_chapitre, commentaire) VALUES(:id_membre, :id_chapitre, :commentaire)");
                $req->execute([
                    "id_membre" => $_SESSION["membre"],
                    "id_chapitre" => $id_chapitre,
                    "commentaire" => nl2br(htmlentities($commentaire))
                    
                ]);
                
            }
            else
                $erreur .= "Vous devez écrire du texte !";
            
            return $erreur;
            
            }
        }



  /**
   * Fonction de gestion des commentaires du blog
   *
   * @param [type] $id_chapitre
   * @return void
   */
  public function getCommentsBlog($id_chapitre)
  {
    $bdd = $this->getBdd();
        
      $id_chapitre = (int)$_GET["id"];
      $req = $bdd->prepare("SELECT commentaires.commentaire, DATE_FORMAT (commentaires.publication, '%d/%m/%Y ') AS publication, commentaires.id_membre, commentaires.id, membres.pseudo, membres.avatar FROM commentaires INNER JOIN membres ON commentaires.id_membre = membres.id AND commentaires.id_chapitre = ? ORDER BY id DESC");
      $req->execute([$id_chapitre]);
      $res = $req->fetchAll();

        return $res;
  }


      /**
     * Fonction de gestion du nombre de commentaires
     *
     * @param [type] $id_chapitre
     * @return void
     */
    public function getnbCommentsBlog($id_chapitre) 
    {
      $bdd = $this->getBdd();
        $id_chapitre = (int)$_GET["id"];

        $req = $bdd->prepare("SELECT COUNT(*) FROM commentaires WHERE id_chapitre = ?");
        $req->execute([$id_chapitre]);
        $res = $req->fetch()[0];
          
          return $res;
    }

         /**
     * Affichage des 5 derniers articles publiés
     *
     * @return void
     */
    public function getLastBlog()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query("SELECT * FROM blog ORDER BY blog.id DESC limit 0,4");
        $res = $req->fetchAll();

        return $res;
    }

      /**
     * AFFICHAGE DE PLUSIEURS chapitres
     *
     * @return void
     */
    public function getChapitresPage($start, $perPage)
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query("SELECT * FROM blog ORDER BY blog.id DESC LIMIT ".$start.",".$perPage);
        $res = $req->fetchAll();
        return $res;
      
    }



    /**
     * Compte des articles
     *
     * @return void
     */
    public function getCount()
    {
        $bdd = $this->getBdd();
        $req = $bdd->query('SELECT COUNT(*) AS total FROM blog ');
        $res = $req->fetch();
        return $res;
    }
   
}