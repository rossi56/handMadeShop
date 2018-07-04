<?php
namespace Rossi56\controllers;
use \Rossi56\models\AdminManager;

use \Rossi56\models\ArticlesManager;
use \Rossi56\models\CommentsManager;
use \Rossi56\models\BlogManager;
use \Rossi56\models\CaddieManager;
use \Rossi56\models\CategoryManager;
use \Rossi56\models\MembresManager;
use \Rossi56\models\MarketManager;




/**
 * Contrôleur Administration
 */
class ControllerAdmin
{
    private $delete;
    private $posts;
    private $commentaires;
    private $membres;
    private $erase;
    private $chapitres;
    private $reports;
    private $admin;
    private $articles;
    private $chapitre;
    private $article;
    private $boutiques;
    private $deleteComment;

    public function __construct()
    {
        $this->admin = new AdminManager;
        $this->comments = new CommentsManager;
        $this->membres = new MembresManager;
        $this->article = new ArticlesManager;
        $this->caddie = new CaddieManager;
        $this->market = new MarketManager;


    }
    
   /**
    * Fonction de publication des chapitres du blog
    *
    * @param [type] $image
    * @param [type] $image1
    * @param [type] $image2
    * @param [type] $image3
    * @param [type] $image4
    * @param [type] $description
    * @param [type] $titre
    * @return void
    */
    public function publier($image,$image1, $image2,$image3,$image4, $description, $titre)
    {
        $posts = $this->admin->poster( $image, $image1, $image2,$image3, $image4, $description, $titre);
       
        extract($_POST);

        $validation = true;

        if(empty($titre) || empty($description)) {//Vérif de présence de contenu et d'un titre
            $validation = false;
           
        }

        if(!isset($_FILES["file"]) OR $_FILES["file"]["error"] > 0) {//Vérif de la présence d'image
            $validation = false;
          
        }
        if(!isset($_FILES["file1"]) OR $_FILES["file2"]["error"] > 0) {//Vérif de la présence d'image
            $validation = false;
           
        }

        if(!isset($_FILES["file2"]) OR $_FILES["file2"]["error"] > 0) {//Vérif de la présence d'image
            $validation = false;

        }
        if(!isset($_FILES["file3"]) OR $_FILES["file3"]["error"] > 0) {//Vérif de la présence d'image
            $validation = false;

        }
        if(!isset($_FILES["file4"]) OR $_FILES["file4"]["error"] > 0) {//Vérif de la présence d'image
            $validation = false;

        }
        if($validation) 
        {
            
            //Récupération de l'image
            $image = basename($_FILES["file"]["name"]);
            $image1 = basename($_FILES["file1"]["name"]);
            $image2 = basename($_FILES["file2"]["name"]);
            $image3 = basename($_FILES["file3"]["name"]);
            $image4 = basename($_FILES["file4"]["name"]);//récupération du nom de l'image et pas du chemin complet avec la fonction basename
            //enregistrement définitif du fichier
            move_uploaded_file($_FILES["file"]["tmp_name"], 'public/img/blog' . $image);
            move_uploaded_file($_FILES["file1"]["tmp_name"], 'public/img/blog' . $image1);
            move_uploaded_file($_FILES["file2"]["tmp_name"], 'public/img/blog' . $image2);
            move_uploaded_file($_FILES["file3"]["tmp_name"], 'public/img/blog' . $image3);
            move_uploaded_file($_FILES["file4"]["tmp_name"], 'public/img/blog' . $image4);



           
            
            unset($_POST["titre"]);
            unset($_POST["contenu"]);
        }
        
        header ('Location: Blog');

    }

 
    /**
     * Récupération des infos membres
     *
     * @return void
     */
    public function members($id)
    {
        $commentaires = $this->comments->lastComments();
        $membres = $this->membres->lastMembers();
        $reports = $this->comments->getReports();
        $admin = $this->membres->infos($id);
        $articles = $this->article->getArticles();
        
            
        require ('views/adminView.php');
    }

    
    /**
     * Validation des commenatires signalés
     *
     * @return void
     */
    public function validate($id)
    {
        $reports = $this->comments->valideReports($id);
        header('Location: Administration');
    }

    /**
     * Supression d'un membre
     *
     * @param [type] $id
     * @return void
     */
    public function deleteMember($id)
    {
       $erase = $this->admin->eraseMember($id);                     
    }


    /**
     * Suppression d'un membre
     *
     * @param [type] $id
     * @return void
     */
    public function deleteComment($id)
    {
        $deleteComment = $this->admin->eraseComment($id);
        header ('Location: Administration');
    }

    /**
     * Fonction de modification des chapitres publiés
     *
     * @return void
     */
    public function editer($id, $titre, $description)
    { 
        $chapitre = $this->admin->editer($id, $titre, $description);
        header ('Location: Edition');
    }

     /**
     * Fonction de modification des articles en vente
     *
     * @return void
     */
    public function editerArt($id, $titre, $description)
    { 
        $article = $this->admin->editerArt($id, $titre, $description);
        header ('Location: Edition');
    }

    
    /**
     * Fonction d'affichage des anciens chapitres publiés
     *
     * @return void
     */
    public function getChapitres()
    {
        $chapitres = $this->admin->getChapitres();
        $articles = $this->article->getArticles();

        require ('views/oldView.php');         
      
    }

    public function getBoutiques()
    {
        $boutiques = $this->market->getBoutiques();

        require ('views/marketListView.php');
    }
        

    /**
     * Fonction modif d'un article
     *
     * @param [type] $id
     * @return void
     */
    public function getChapitre($id)
    {
        $chapitre = $this->admin->getChapitre($id);
        require ('views/modifView.php');
       
    }

    public function getArticle($id)
    {
      $article = $this->article->getArticle($id);
      require ('views/modifArtView.php');
    }


    /**
     * Fonction supression d'un chapitre et de ses commentaires
     *
     * @return void
     */
    public function deleteChapitre($id)
    {
        $delete = $this->admin->eraseComments($id);
        $delete = $this->admin->deleteChapitre($id);    
    }

     /**
     * Fonction supression d'un chapitre et de ses commentaires
     *
     * @return void
     */
    public function deleteArticle($id)
    {
        $delete = $this->admin->eraseComments($id);
        $delete = $this->admin->deleteArticle($id);    
    }

     
    /**
     * Fonction de déconnexion
     *
     * @return void
     */
    public function deconnexion() 
    {
        
        $_SESSION = array();
        session_destroy();
        session_start();
        header('Location: Article');
    }
}