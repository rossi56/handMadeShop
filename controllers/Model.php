<?php

namespace Rossi56\models;
/**
 * Connexion à la base de données
 */

abstract class Model
{
    private static $_bdd;

    /**
     * Instanciation de la connexion à la base de données
     *
     * @return void
     */
    private static function setBdd()
    {
        self::$_bdd = new \PDO('mysql:dbname=rossidwfcshandma; host=rossidwfcshandma.mysql.db; charset=utf8', 'rossidwfcshandma', 'corvetteC235');
     
        self::$_bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
       
    }
    
    /**
     * Récupération de la connexion à la base de données
     *
     * @return void
     */
    protected function getBdd()
    {
        if(self::$_bdd == null)
          self::setBdd();
        return self::$_bdd;
    }
}







        









