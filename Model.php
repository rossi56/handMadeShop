<?php
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
        self::$_bdd = new PDO('mmysql:dbname=rossidwfcspro5; host=rossidwfcspro5.mysql.db; charset=utf8', 'rossidwfcspro5', 'corvetteC235');
     
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
       
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







        









