<?php
namespace Rossi56\models;
use \Rossi56\models\Model;


/**
 * Gestions des membres
 */
class MembresManager extends Model
{

    /**
     * Fonction pour vérifier si pseudo est disponible dans la base de données
     *
     * @param [type] $pseudo
     * @return void
     */
    public function existe($pseudo) {
        $bdd = $this->getBdd();

        $resultat = $bdd->prepare("SELECT COUNT(*) FROM membres WHERE pseudo = ?");
        $resultat->execute([$pseudo]);
        $resultat = $resultat->fetch()[0];

        return $resultat;
    }

    /**
     * Fonction de gestion des erreurs d'entrées dans les champs du formulaire d'inscription
     *
     * @param [type] $pseudo
     * @param [type] $email
     * @param [type] $emailconf
     * @param [type] $password
     * @param [type] $passwordconf
     * @return void
     */
    public function inscription($pseudo, $email, $emailconf, $adressFacture, $adressLivraison, $password, $passwordconf)
    {
        $bdd = $this->getBdd();

        $inscription = $bdd->prepare("INSERT INTO membres (pseudo, email, adressFacture, adressLivraison, `password`, avatar) VALUES(:pseudo, :email, :adressFacture, :adressLivraison, :password, :avatar)");
        $inscription->execute([
            "pseudo" => htmlentities($pseudo),
            "email" => htmlentities($email),
            "adressFacture" => htmlentities($adressFacture),
            "adressLivraison" => htmlentities($adressLivraison),
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "avatar" => "user2.png"              
        ]);
        // array_push(self::$erreurs,  "Votre inscription a bien été prise en compte");
        unset($_POST["pseudo"]);
        unset($_POST["email"]);
        unset($_POST["emailconf"]);
        unset($_POST["adressFacture"]);
        unset($_POST["adressLivraison"]);


        //Vider les champs après validation

       
    }
 

    /**
     * Fonction connexion membre
     *
     * @param [type] $pseudo
     * @return void
     */
    public function connexion($pseudo){
        $bdd = $this->getBdd();
        
    //extraire donnée de la table membre
        extract($_POST);

        $req = $bdd->prepare("SELECT id, password FROM membres WHERE pseudo = ?");
        $req->execute([$pseudo]);
        $res = $req->fetch();
            
        return $res;
    }


    /**
     * Fonction affichage du profil des membres
     *
     * @param [type] $id
     * @return void
     */
    public function infos($id)
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
        $req->execute([$id]);
        $res = $req->fetch();

        return $res;
    }

    /**
     * Fonction affichage du profil des membres
     *
     * @param [type] $id
     * @return void
     */
    public function infosMembres()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->prepare("SELECT * FROM membres");
        $res = $req->fetchAll();

    }


    /**
     * Affichage des 5 derniers membres inscrits
     *
     * @return void
     */
    public function lastMembers()
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->query("SELECT id, pseudo, avatar FROM membres ORDER BY id DESC LIMIT 0,5");
        $res = $req->fetchall();

        return $res;
    }


    /**
     * Sélection d'un membre pour éditer un profil
     *
     * @param [type] $id
     * @return void
     */
    public function selectUser($id)
    {
        $bdd = $this->getBdd();
        $req = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
        $req->execute([$id]);
        $res = $req->fetch();
        return $res;
    }


    /**
     * Remplacement du pseudo du profil membre
     *
     * @param [type] $id
     * @param [type] $newPseudo
     * @return void
     */
    public function newPseudo($id, $newPseudo)
    {
        $bdd = $this->getBdd();
        $newPseudo = htmlentities($_POST['newPseudo']);
        $req = $bdd->prepare("UPDATE membres SET pseudo = :pseudo WHERE id = :id");
        $req->execute(array(
            'pseudo' => $newPseudo,
            'id' => $id));
        
    }

    /**
     * Remplacement du pseudo du profil membre
     *
     * @param [type] $id
     * @param [type] $newPseudo
     * @return void
     */
    public function newAdressLivraison($id, $newLivraison)
    {
        $bdd = $this->getBdd();
        $newLivraison = htmlentities($newLivraison);
        $req = $bdd->prepare("UPDATE membres SET adressLivraison = :adressLivraison WHERE id = :id");
        $req->execute(array(
            'adressLivraison' => $newLivraison,
            'id' => $id));
        
    }

      /**
     * Remplacement du pseudo du profil membre
     *
     * @param [type] $id
     * @param [type] $newPseudo
     * @return void
     */
    public function newAdressFActure($id, $newFacture)
    {
        $bdd = $this->getBdd();
        $newFacture = htmlentities($newFacture);
        $req = $bdd->prepare("UPDATE membres SET adressFacture = :adressFacture WHERE id = :id");
        $req->execute(array(
            'adressFacture' => $newFacture,
            'id' => $id));
        
    }

    /**
     * Remplacement du Mail du profil membre
     *
     * @param [type] $id
     * @param [type] $newMail
     * @return void
     */
    public function newMail($id, $newMail)
    {
        $bdd = $this->getBdd();
        $newMail = htmlentities($_POST['newMail']);
        $req = $bdd->prepare("UPDATE membres SET email = :email WHERE id = :id");
        $req->execute(array(
            'email' => $newMail,
            'id' => $id));
    }

/**
 * Remplacement du Mot de passe du profil membre
 *
 * @param [type] $id
 * @param [type] $newMdp
 * @return void
 */
    public function newMdp($id, $newMdp)
    {
        $bdd = $this->getBdd();
        
        $req = $bdd->prepare("UPDATE membres SET password = :password WHERE id = :id");
        $req->execute(array(
            'password' =>  password_hash($newMDP, PASSWORD_DEFAULT),
            'id' => $id));
    }

    public function newAvatar($avatar, $id)
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("UPDATE membres SET avatar = :avatar WHERE id = :id");
        $req->execute(array(
            'avatar' => $avatar,
            'id' => $id

        ));
    }

    public function getVendor($id)
    {
        $bdd = $this->getBdd(); 

        $req = $bdd->prepare('SELECT articles.id, membres.* FROM articles INNER JOIN membres ON articles.id_membre = membres.id WHERE articles.id = ? ');
        $req->execute([$id]);
        $res = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $res;

    }



}