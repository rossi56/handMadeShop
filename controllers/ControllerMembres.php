<?php
require_once 'models/MembresManager.php';
require_once 'models/CaddieManager.php';
require_once 'models/CommentsManager.php';
require_once 'models/ArticlesManager.php';
require_once 'models/CategoryManager.php';

/**
 * Contrôleur Membres
 */
class ControllerMembres
{
    private $compte;
    private $commentaires;
    private $membres;
    private static $user;
    private $userManager;
    private $mail;
    private $pseudo;
    private $facture;
    private $livraison;
    private $password;
    private $avatar;
    private $image;
    private $count;
    private $article;
    private $chapitre;
    private $nb_articles;
    private $categories;
    private $markets;
    private $delete;
    private static $erreurs = [];
    
    public function __construct()
    {
        $this->membre = new MembresManager;
        $this->comment = new CommentsManager;
        $this->caddie = new CaddieManager;
        $this->article = new ArticlesManager;
        $this->category = new CategoryManager;
        $this->market = new MarketManager;
    }
    
    /**
     * Fonction d'inscription
     *
     * @param [type] $pseudo
     * @param [type] $email
     * @param [type] $emailconf
     * @param [type] $password
     * @param [type] $passwordconf
     * @return void
     */
    public function inscrire($pseudo, $email, $emailconf, $adressFacture, $adressLivraison, $password, $passwordconf)
    {      
        

        $validation = true;
        if(empty($pseudo) || empty($email) || empty($emailconf) || empty($adressFacture) || empty($adressLivraison) || empty($password) || empty($passwordconf))
        {
            $validation = false;
        }
        if($this->membre->existe($pseudo))
        {
            $validation = false;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $validation = false;
        }
        elseif ($emailconf != $email) 
        {
            $validation = false;
        }
        if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$#', $password)) 
        {
            $validation = false;
        }
        if($passwordconf != $password) 
        {
            $validation = false;
        }
        if($validation) 
        {
            $membres = $this->membre->inscription($pseudo, $email, $emailconf,$adressFacture, $adressLivraison, $password, $passwordconf);
        }
        header('Location: Page-de-connexion');
    }

    public function getPage($id_membre)
    {
        $categories = $this->category->getCategories();
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        require ('views/inscriptionView.php');


    }

    public function getPageConnect()
    {
        $categories = $this->category->getCategories();
        require ('views/connexionView.php');             
    }
 
   
    /**
     * Fonction de connexion
     *
     * @param [type] $pseudo
     * @return void
     */
    public function connect($pseudo)
    {
        $compte = $this->membre->connexion($pseudo);
        
       
        if(password_verify($_POST['password'], $compte["password"]))
        {
            $_SESSION["membre"] = $compte["id"];
            header("Location: Compte-utilisateur");
        }
        else
        {
        require ('views/connexionView.php');
        }
    }


    /**
     * Vérification de l'existence d'un pseudo en base de donnée
     *
     * @param [type] $pseudo
     * @return void
     */
    public function pseudoExist($pseudo)
    {
        $pseudo = $this->membre->existe($pseudo);
    }

    public function infos($id, $id_membre)
    {
        self::$user = $this->membre->selectUser($id);
        $compte = $this->membre->infos($id_membre);
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();
        require ('views/editProfilView.php');
        

    }

        
    /**
     * Fonction de déconnexion
     *
     * @return void
     */
     public function deconnexion() {
        session_start();
        $_SESSION = array();
        $_SESSION['membre'] = null;
        session_destroy();
        unset($_SESSION);
        unset($_COOKIE);
        header("Location: Page-de-connexion");
    }
    
    /**
     * Fonction Espace Membre
     *
     * @param [type] $id
     * @return void
     */
    public function compte($id_membre)
    {
        $commentaires = $this->comment->commentaires_user();
        $blogComments = $this->comment->commentaires_blog();
        $compte =  $this->membre->infos($id_membre);
        $count = $this->caddie->totalPriceCaddie($id_membre);
        $articles = $this->caddie->getCaddie();
        $nb_articles = $this->caddie->getNbArticles($id_membre);
        $categories = $this->category->getCategories();
        $markets = $this->market->getOneMarketMembre($id_membre);
        $userArticles = $this->article->articles_user();
        require('views/compteView.php');
    }


 
   


    /**
     * Suppression d'un commentaire
     *
     * @param [type] $id
     * @return void
     */
    public function deleteComment($id)
    {
        $delete = $this->comment->deleteComment($id);
        header ('Location: Compte-utilisateur');
    }
   

    public function livraisonAdress($id, $livraisonAdress)
    {
        
    }
    
    /**
     * Edition du profil membre
     *
     * @param [type] $id
     * @return void
     */
    public function update($id, $newPseudo, $newMail, $newFacture, $newLivraison, $password, $avatar)
    {
            self::$user = $this->membre->selectUser($id);
      
            if(isset($_POST['newPseudo']) AND !empty($_POST['newPseudo']) AND $_POST['newPseudo'] != self::$user['pseudo'])
            {   
                $pseudo = $this->membre->newPseudo($id, $newPseudo);
            }
            if(isset($_POST['newMail']) AND !empty($_POST['newMail']) AND $_POST['newMail'] != self::$user['Mail'])
            {  
                $mail = $this->membre->newMail($id, $newMail);
            }
            if(isset($_POST['newAdressFacture']) AND !empty($_POST['newAdressFacture']) AND $_POST['newAdressFacture'] != self::$user['adressFacture'])
            { 
                $facture = $this->membre->newAdressFacture($id, $newFacture);
            }
            if(isset($_POST['newAdressLivraison']) AND !empty($_POST['newAdressLivraison']) AND $_POST['newAdressLivraison'] != self::$user['adressLivraison'])
            {  
                $livraison = $this->membre->newAdressLivraison($id, $newLivraison);
            }
                
            if(isset($_POST['newPassword']) AND !empty($_POST['newPassword']) AND isset($_POST['newPasswordConf']) AND !empty($_POST['newPasswordConf']))
            {
                if($password == $passwordconf)
                {
                    $password = $this->membre->newMDP($id, $_POST['newPassword']);
                }
                else
                {
                  array_push(self::$erreurs, 'Vos 2 mots de passe sont différents');
                }
            }
            if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']));
            {
                $avatar = $this->membre->newAvatar($avatar, $id);

                $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
                if($_FILES['avatar']['size'] <= 2097152)
                {
                    if(in_array(strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)), $extensionsValides))
                    {
                        $avatar = move_uploaded_file($_FILES['avatar']['tmp_name'],"public/avatars/");
                        if($avatar)
                        {
                            array_push(self::$erreurs, "Votre avatar a bien été mis à jour !");
                        }
                        else
                        {
                            array_push(self::$erreurs, "Une erreur s'est produite durant l'importation de l'avatar !");
                        }
                    }
                    else
                    {
                        array_push(self::$erreurs, 'Votre avatar doit être au format jpg, jpeg, gif ou png');
                    }
                }
                else
                {
                    array_push(self::$erreurs, 'Votre avatar ne doit pas dépasser 2Mo');
                }
            }
       header('Location: Compte-utilisateur');
    }
  
    
    
    /**
     * Récupération d'un membre pour édition du profil membre
     *
     * @return void
     */
    public static function getUser()
    {
       
        return self::$user;
        
    }

    public static function getErreurs()
    {
        return self::$erreurs;
    }

   
}