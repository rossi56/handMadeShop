<?php
require_once ('models/ContactManager.php');
require_once ('models/CaddieManager.php');
require_once ('models/CategoryManager.php');



use Projet5\controllers;


/**
 * Contrôleur de la page de contact
 */
class ControllerContact
{
    private $contact;
    private $validation;
    public static $erreurs = [];
    private $nb_articles;
    private $categories;
   

    public function __construct()
    {
        $this->contact = new ContactManager;
        $this->caddie = new CaddieManager;
        $this->category = new CategoryManager;
    }


    /**
     * Fonction de la page de contact
     *
     * @param [type] $email
     * @param [type] $nom
     * @param [type] $prenom
     * @param [type] $texte
     * @return void
     */
    public function contact($email, $nom, $prenom, $texte)
    {
        $contact = $this->contact->contact($email, $nom, $prenom, $texte);
       
        

        $validation = true; //variable de validation, s'il y a une erreur passera à false et pas d'envoi
    
        if(empty($prenom) || empty($nom) || empty($email) || empty($texte)) {
            $validation = false;
            // array_push(self::$erreurs," <i class='fas fa-exclamation-triangle'></i> <br> Tous les champs sont obligatoires !" );
        }
    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation = false;
        //     array_push(self::$erreurs, " <i class='fas fa-exclamation-triangle'></i> <br> L'adresse e-mail n'est pas valide !
        //    ");
    
        }
    
        if($validation) {
            // array_push(self::$erreurs, '<h2>Votre Message a bien été envoyé !</h2>
            // <i class="far fa-check-circle"></i>
            //  ');
            //envoyer 
            $to = "rossi56@hotmail.fr";  
            $sujet = "Nouveau message de " . $nom . ' '. $prenom;
            $message = '
            <h1>Nouveau message de ' . $nom . ' '. $prenom . '</h1>
            <h2>Adresse e-mail : ' . $email . '</h2>
            <p>' . nl2br($texte) . '</p>  
            ';
            //  retour à la ligne du texte enregistré
            $headers = 'From: ' . $nom . $prenom . '<' . $email . '>' . "\r\n"; 
            //retour à la ligne plusieurs headers
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    
            mail($to, $sujet, $message, $headers);

            //Destruction des champs après envoi du formulaire, éviter qu'il soit envoyé plusieurs fois
            unset($_POST["nom"]);
            unset($_POST["prenom"]);
            unset($_POST["email"]);
            unset($_POST["texte"]);
        }


        header('Location: Article&id=');
    }

    /**
     * Fonction de récupération des erreurs de formulaires
     *
     * @return void
     */
    public static function getErreur()
    {
        return self::$erreurs;
    }
}

