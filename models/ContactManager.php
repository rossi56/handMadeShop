<?php
namespace Rossi56\models;
use \Rossi56\models\Model;



/**
 * Gestion de la page de contact
 */
class ContactManager extends Model
{
    /**
     * Fonction envoie de mail
     *
     * @param [type] $email
     * @param [type] $nom
     * @param [type] $prenom
     * @param [type] $texte
     * @return void
     */
    public function contact($email, $nom, $prenom, $texte)
    {
        $bdd = $this->getBdd();

        extract($_POST);

        
    }
}