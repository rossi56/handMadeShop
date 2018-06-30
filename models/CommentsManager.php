<?php
namespace Rossi56\models;
use \Rossi56\models\Model;



/**
 * Gestion des commentaires
 */
class CommentsManager extends Model
{

  /**
   * Fonction de gestion des commentaires article
   *
   * @param [type] $id_article
   * @return void
   */
  public function getCommentsArticle($id_article)
  {
    $bdd = $this->getBdd();
        
     
      $commentaires = $bdd->prepare("SELECT commentaires.commentaire, DATE_FORMAT (commentaires.publication, '%d/%m/%Y ') AS publication, commentaires.id_membre, commentaires.id, membres.pseudo, membres.avatar FROM commentaires INNER JOIN membres ON commentaires.id_membre = membres.id AND commentaires.id_article = ? ORDER BY id DESC");
      $commentaires->execute([$id_article]);
      $commentaires = $commentaires->fetchAll();

        return $commentaires;
  }
        
    /**
     * Fonction de gestion du nombre de commentaires
     *
     * @param [type] $id_article
     * @return void
     */
    public function getnbComments($id_article) 
    {
      $bdd = $this->getBdd();
        $id_article = (int)$_GET["id"];

        $nb_commentaires = $bdd->prepare("SELECT COUNT(*) FROM commentaires WHERE id_article = ?");
        $nb_commentaires->execute([$id_article]);
        $nb_commentaires = $nb_commentaires->fetch()[0];
          
          return $nb_commentaires;
    }

    /**
     * Fonction de gestion des commentaires utilisateurs
     *
     * @return void
     */  
    public function commentaires_user()
    {
      $bdd =$this->getBdd();

        $req = $bdd->prepare("SELECT commentaires.commentaire, commentaires.id, DATE_FORMAT (commentaires.publication, '%d/%m/%Y ') AS publication, commentaires.id_membre, commentaires.id_article, articles.titre, articles.img, articles.id FROM commentaires INNER JOIN articles ON commentaires.id_article = articles.id AND commentaires.id_membre = ? ORDER BY commentaires.id DESC  ");
        $req->execute([$_SESSION["membre"]]);
        $res = $req->fetchAll();
          
          return $res;
    }
    /**
     * Fonction de gestion des commentaires utilisateurs
     *
     * @return void
     */  
    public function commentaires_blog()
    {
      $bdd =$this->getBdd();

        $req = $bdd->prepare("SELECT commentaires.commentaire, commentaires.id, DATE_FORMAT (commentaires.publication, '%d/%m/%Y ') AS publication, commentaires.id_membre, commentaires.id_article, blog.titre, blog.image_art, blog.id FROM commentaires INNER JOIN blog ON commentaires.id_chapitre = blog.id AND commentaires.id_membre = ? ORDER BY commentaires.id DESC  ");
        $req->execute([$_SESSION["membre"]]);
        $res = $req->fetchAll();
          
          return $res;
    }

    

  


    /**
     * Affichage des 5 derniers commentaires
     *
     * @return void
     */
    public function lastComments()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query("SELECT  commentaires.commentaire, commentaires.id, DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, commentaires.id_membre, membres.pseudo, membres.avatar FROM commentaires INNER JOIN membres ON commentaires.id_membre = membres.id ORDER BY commentaires.id DESC limit 0,5");
        $res = $req->fetchAll();

        return $res;
    }


    /**
     * Affichage des commentaires signalés
     *
     * @return void
     */
    public function getReports()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query("SELECT commentaires.report, commentaires.commentaire,DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, commentaires.id, commentaires.id_article,commentaires.id_chapitre, membres.* FROM commentaires INNER JOIN membres ON commentaires.id_membre = membres.id WHERE report != 0");
       
        return $req;
    }


    /**
     * Validation des commentaires signalés
     *
     * @return void
     */
    public function valideReports($id)
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->prepare("UPDATE commentaires SET report = 0 WHERE id = ?");
        $req->execute([$_GET['id']]);
    }

    /**
     * Supression d'un commentaire
     *
     * @param [type] $id
     * @return void
     */
    public function deleteComment($id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare('DELETE FROM commentaires WHERE id = ?');
        $req->execute([$id]);

        return $req;
    }
    

   
}