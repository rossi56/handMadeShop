<?php
 session_start();
require 'vendor/autoload.php';
use \Rossi56\controllers\ControllerAdmin;
use \Rossi56\controllers\ControllerArticles;
use \Rossi56\controllers\ControllerOneArticle;
use \Rossi56\controllers\ControllerContact;
use \Rossi56\controllers\ControllerMembres;
use \Rossi56\controllers\ControllerBlog;
use \Rossi56\controllers\ControllerMarket;
use \Rossi56\controllers\ControllerCategory;
use \Rossi56\controllers\ControllerCaddie;






class Router {

  private $ctrlArticles;
  private $ctrlOneArticle;
  private $ctrlMembres;
  private $ctrlContact;
  private $ctrlBlog;
  private $ctrlMarket;
  private $ctrlCategory;
  private $ctrlCaddie;
  private $ctrlAdmin;

  public function __construct() 
  {
    $this->ctrlArticles = new ControllerArticles;
    $this->ctrlOneArticle = new ControllerOneArticle;
    $this->ctrlMembres =  new ControllerMembres;
    $this->ctrlContact = new ControllerContact;
    $this->ctrlBlog = new ControllerBlog;
    $this->ctrlMarket = new ControllerMarket;
    $this->ctrlCategory = new ControllerCategory;
    $this->ctrlCaddie = new ControllerCaddie;
    $this->ctrlAdmin = new ControllerAdmin;
    
    
  }

  /**
   * Traite une requête entrante
   *
   * @return void
   */
  public function routerReq() 
  {
    try 
    {
      if (isset($_GET['action']))
       {
        if ($_GET['action'] == 'Chapitre') 
        {   
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                if(isset($_SESSION['membre']))
                {
                    $this->ctrlBlog->chapitreMembre($_GET['id'], $_SESSION['membre']);    
                }
                else
                {
                    $this->ctrlBlog->chapitre($_GET['id']); 
                }
            }
            else
            {
              throw new Exception('Page introuvable');

            }
        }
        elseif ($_GET['action'] == 'Blog') 
        {   
            if(isset($_SESSION['membre']))
            {
                if(isset($_POST['parPage']))
                {
                    $this->ctrlBlog->getChapitresPage($_GET['page'], $_POST['parPage'],  $_SESSION['membre']); 

                }
                else
                {
                    $this->ctrlBlog->getChapitresPage($_GET['page'], $_POST['parPage'] = 4,  $_SESSION['membre']); 

                }
                
               
            }
            else
            {if(isset($_POST['parPage']))
                {
                    $this->ctrlBlog->getChapitresPage($_GET['page'], $_POST['parPage'],  $_SESSION['membre'] = null); 

                }
                else
                {
                    $this->ctrlBlog->getChapitresPage($_GET['page'], $_POST['parPage'] = 4,  $_SESSION['membre'] = null); 

                }
            }   

          
        }
        elseif ($_GET['action'] == 'Articles') 
        {             
            if(isset($_SESSION['membre']))
            {
                if(isset($_POST['parPage']))
                {
                    $this->ctrlArticles->getArticlesPage($_GET['page'], $_POST['parPage'], $_SESSION['membre']);

                }
                else
                {
                $this->ctrlArticles->getArticlesPage($_GET['page'], $_POST['parPage'] = 10, $_SESSION['membre']);

                }
                     
                 
            }
            else
            { 
                if(isset($_POST['parPage']))
                {
                $this->ctrlArticles->getArticlesPage($_GET['page'], $_POST['parPage'] , $_SESSION['membre']=null); 
                } 
                else
                {
                $this->ctrlArticles->getArticlesPage($_GET['page'], $_POST['parPage'] = 10, $_SESSION['membre'] = null);

                }  

            }
            
                
        }
        elseif ($_GET['action'] == 'Accueil') 
        {   
            if(isset($_SESSION['membre']))
            {
                $this->ctrlArticles->accueilMembre($_SESSION["membre"]);
            }
            else
            {
                $this->ctrlArticles->accueil();   
            }   
        }
        elseif ($_GET['action'] == 'Article') 
        {
             
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                $this->ctrlOneArticle->article($_GET['id'], $_SESSION['membre']);  
            } 
            else
            {
              throw new Exception('Page introuvable');

            }
               
        }
        elseif ($_GET['action'] == 'Hand-Made-Shop') 
        {
            require ('views/home.php');
        }
        elseif ($_GET['action'] == 'Commenter') 
        {
            $this->ctrlOneArticle->postComment( $_SESSION["membre"],$_GET['id'], $_POST['commentaire']);           
        }
        elseif ($_GET['action'] == 'Commenter-le-blog') 
        {
            $this->ctrlBlog->postCommentBlog( $_SESSION["membre"],$_GET['id'], $_POST['commentaire']);           
        }
        elseif ($_GET['action'] == 'Ajouter-au-caddie') 
        {
            $this->ctrlCaddie->addArticle($_GET['id'], $_SESSION["membre"], $_GET["price"], $_GET['quantite']);              
        }
        elseif ($_GET['action'] == 'Plus') 
        {
            $this->ctrlCaddie->articlePlus($_GET['id']);               
        }
        elseif ($_GET['action'] == 'Moins') 
        {
            $this->ctrlCaddie->articleMoins($_GET['id']);               
        }
        elseif ($_GET['action'] == 'Ma-boutique') 
        {
            $this->ctrlMarket->getOneMarket($_GET['id'], $_SESSION['membre']);   
        }
        elseif ($_GET['action'] == 'Inscription') 
        {  
            if(empty($_POST))
            {
                if(isset($_SESSION['membre']))
                {
                    $this->ctrlMembres->getPage($_SESSION['membre']);
                }
                else
                {
                    $this->ctrlMembres->getPage($_SESSION['membre']=null);

                }
            }
            else
            {
                extract($_POST);
                $this->ctrlMembres->inscrire($pseudo, $email, $emailconf, $adressFacture, $adressLivraison, $password, $passwordconf);  
                $this->ctrlMembres->pseudoExist($pseudo);
            }      
        }
        elseif ($_GET['action'] == 'Page-de-connexion') 
        {
            
            $this->ctrlMembres->getPageConnect();
         
        }
        elseif ($_GET['action'] == 'Connexion') 
        {
            $this->ctrlMembres->connect($_POST['pseudo']);                   
        }
        elseif ($_GET['action'] == 'Deconnexion') 
        {
            $this->ctrlMembres->deconnexion();         
        }
        elseif ($_GET['action'] == 'Facture') 
        {
            $this->ctrlCaddie->getFacture($_SESSION['membre']);         
        }
        elseif ($_GET['action'] == 'Les-sous-Categories') 
        {
            if(isset($_SESSION['membre']))
            {
            $this->ctrlCategory->getOneCategorie($_GET['id'], $_SESSION['membre']); 
                
            }
            else
            {
            $this->ctrlCategory->getOneCategorie($_GET['id'], $_SESSION['membre']=null); 
               
            }    
        }
        elseif ($_GET['action'] == 'Sous-Categorie-Articles') 
        {
            $this->ctrlCategory->getSubCatArticles($_GET['id'], $_SESSION['membre']); 
        }
        elseif ($_GET['action'] == 'Les-Categories') 
        {
            if(isset($_SESSION['membre']))
            {
            $this->ctrlCategory->getCategories($_SESSION['membre']); 
            }
            else
            {
                $this->ctrlCategory->getCategories($_SESSION['membre']=null); 
            }

        }
        elseif ($_GET['action'] == 'Compte-utilisateur') 
        {
            $this->ctrlMembres->compte($_SESSION['membre']);

        }
        elseif ($_GET['action'] == 'Facture') 
        {
            $this->ctrlCaddie->getFacture($_SESSION['membre']);

        }
        elseif ($_GET['action'] == 'Supprimer-un-commentaire') 
        {           
            $this->ctrlMembres->deleteComment($_GET['id']);
            require('views/compteView.php');
        }
        elseif ($_GET['action'] == 'Boutiques') 
        {           
            $this->ctrlMarket->visitMarket( $_GET['id']);
        }
        elseif ($_GET['action'] == 'Boutique-Articles') 
        {           
            $this->ctrlMarket->visitMarketArt($_GET['id'], $_SESSION['membre']);
        }
        elseif ($_GET['action'] == 'Ouverture-de-boutique') 
        {
            if(empty($_POST))
            {
                $this->ctrlMarket->getPage($_SESSION['membre']);
            }
            else
            {
                $this->ctrlMarket->create(( $_FILES['file']["name"]), $_POST['description'], $_POST['marketName'], $_SESSION['membre']); 
                require ('views/newMarketView.php'); 
            }
        }
        elseif ($_GET['action'] == 'Supprimer-un-article')
        {
             $this->ctrlMarket->deleteArtMarket($_GET['id']);
             require ('views/marketView.php');
        }
        elseif ($_GET['action'] == 'Supprimer')
        {
             $this->ctrlCaddie->deleteArticleCaddie($_GET['id']);
             require ('views/inscriptionView.php');
        }
        elseif ($_GET['action'] == 'Supprimer-une-boutique')
        {
             $this->ctrlMarket->deleteMarket($_GET['id']);
        }
        elseif ($_GET['action'] == 'Nouvel-article') 
        {
            if(!empty($_POST))
            {
                
                $this->ctrlArticles->addArticle($_POST['titre'], ($_FILES['file1']["name"]), ($_FILES['file2']["name"]), ($_FILES['file3']["name"]), $_POST['category'], $_POST['subCategory'], $_POST['disponibility'], $_POST['price'], $_POST['livraison'],  $_POST['livraisonPrice'],  $_POST['realisation'],  $_POST['country'],  $_POST['retours'], $_POST['description'], $_GET['id'], $_SESSION['membre']); 
                
            }
                $this->ctrlArticles->getPage($_GET['id'], $_SESSION['membre']);
          


        }
        elseif ($_GET['action'] == 'Contact') 
        {
            if(empty($_POST))
            {
                $this->ctrlCategory->getCategories($_SESSION['membre']);
            }
            else
            {
                extract($_POST);
                $this->ctrlContact->contact($email, $nom, $prenom, $texte, $_GET['id']); 
            }                
        }
        elseif ($_GET['action'] == 'Recherche') 
        {
            $this->ctrlArticles->search(htmlentities($_POST["query"]), $_SESSION['membre']);              
        }
        elseif ($_GET['action'] == 'Favoris')
        {
            $this->ctrlOneArticle->addFavoris($_GET['id_article']);
            header("Location: Article&id=".$_GET['id_article']);
        }
        elseif ($_GET['action'] == 'Edition-du-profil')
        {  
            if(empty($_POST))
            {
                
                $this->ctrlMembres->infos($_GET['id'], $_SESSION['membre']);
               
            }
            else
            {
                
                $this->ctrlMembres->update($_GET['id'], $_POST['newPseudo'], $_POST['newMail'], $_POST['newAdressFacture'], $_POST['newAdressLivraison'],$_POST['newPassword'],$_FILES['avatar']['name']);
            }
          
        }
        elseif ($_GET['action'] == 'Signaler')
        {
            $this->ctrlOneArticle->reportComment($_GET['id'], $_GET['id_chapitre']);
        }
      
        /***********************************************    ESPACE ADMINISTRATION  ******************************************** */
        elseif ($_GET['action'] == 'Administration') 
                {
                    if(isset($_GET['id']))
                    {
                        $this->ctrlAdmin->deleteMember($_GET['id']);
                        $this->ctrlAdmin->deleteComment($_GET['id']);
                    }
                   
                    $this->ctrlAdmin->members($_SESSION['membre']);
                }
            
                if ($_GET['action'] == 'Publication') 
                {
                    if(!empty($_POST))
                    {
                        $this->ctrlAdmin->publier(($_FILES['file']["name"]), ($_FILES['file1']["name"]), ($_FILES['file2']["name"]),($_FILES['file3']["name"]),($_FILES['file4']["name"]), $_POST['description'], $_POST['titre']); 
                        require ('views/publicationView.php');   
                    }
                    require ('views/publicationView.php');                          
                }
                elseif ($_GET['action'] == 'Edition') 
                {
                    $this->ctrlAdmin->getChapitres();
    
                }
                elseif ($_GET['action'] == 'Les-Boutiques') 
                {
                    $this->ctrlAdmin->getBoutiques();
    
                }
                
              
                elseif ($_GET['action'] == 'Modifier-un-chapitre')
                {
                    if(!empty($_POST['titre']) && !empty($_POST['description']) )
                    {
                        $this->ctrlAdmin->editer($_GET['id'],$_POST['titre'],$_POST['description']);
                    }
                    else
                    {
                        $this->ctrlAdmin->getChapitre($_GET['id']);
                    }
                }
                elseif ($_GET['action'] == 'Modifier-un-article')
                {
                    if(!empty($_POST['titre']) && !empty($_POST['description']) )
                    {  
                        $this->ctrlAdmin->editerArt($_GET['id'],$_POST['titre'],$_POST['description']);
                    }
                    else
                    {
                        $this->ctrlAdmin->getArticle($_GET['id']);

                    }
                }
                
              
                elseif ($_GET['action'] == 'Supprimer')
                {
                     $this->ctrlAdmin->deleteChapitre($_GET['id']);
                    header ('Location: Edition');
                }
                elseif ($_GET['action'] == 'Supprimer-un-article')
                {
                     $this->ctrlAdmin->deleteArticle($_GET['id']);
                    header ('Location: Edition');
                }
              
                elseif ($_GET['action'] == 'Supprimer-un-commentaire') 
                {
                   
                        $this->ctrlAdmin->deleteComment($_GET['id']);
                
                    
                }
                elseif ($_GET['action'] == 'Validation') 
                {
                    $this->ctrlAdmin->validate($_GET['id']);
                }
                

            }
                else
                throw new Exception("Aucune action");        
            }
      catch (Exception $e) 
      {
       header ('Location: views/home.php');
      }
    }
}

 
