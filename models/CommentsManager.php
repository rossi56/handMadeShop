<?php
require_once ('models/Model.php');

/**
 * Gestion des commentaires
 */
class CommentsManager extends Model
{

  /**
   * Fonction de gestion des commentaires
   *
   * @param [type] $id_article
   * @return void
   */
  public function getComments($id_article)
  {
    $bdd = $this->getBdd();
        
      $id_article = (int)$_GET["id"];
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

        $commentaires = $bdd->prepare("SELECT commentaires.commentaire, commentaires.id, DATE_FORMAT (commentaires.publication, '%d/%m/%Y ') AS publication, commentaires.id_membre, articles.titre FROM commentaires INNER JOIN articles ON commentaires.id_article = articles.id AND commentaires.id_membre = ? ");
        $commentaires->execute([$_SESSION["membre"]]);
        $commentaires = $commentaires->fetchAll();
          
          return $commentaires;
    }

  


    /**
     * Affichage des 5 derniers commentaires
     *
     * @return void
     */
    public function lastComments()
    {
        $bdd = $this->getBdd();
        
        $last = $bdd->query("SELECT  commentaires.commentaire, commentaires.id, DATE_FORMAT (publication, '%d/%m/%Y ') AS publication, commentaires.id_membre, membres.pseudo, membres.avatar FROM commentaires INNER JOIN membres ON commentaires.id_membre = membres.id ORDER BY commentaires.id DESC limit 0,5");
        $last = $last->fetchAll();

        return $last;
    }


    /**
     * Affichage des commentaires signalés
     *
     * @return void
     */
    public function getReports()
    {
        $bdd = $this->getBdd();
        
        $report = $bdd->query("SELECT commentaires.report, commentaires.commentaire, commentaires.id, membres.pseudo, membres.avatar FROM commentaires INNER JOIN membres ON commentaires.id_membre = membres.id WHERE report != 0");
       
        return $report;
    }


    /**
     * Validation des commentaires signalés
     *
     * @return void
     */
    public function valideReports()
    {
        $bdd = $this->getBdd();
        
        $report = $bdd->prepare("UPDATE commentaires SET report = 0 WHERE id = ?");
        $report->execute([$_GET['id']]);
    }

   
}