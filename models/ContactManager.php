<?php
require_once ('models/Model.php');

use Projet5\models;


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