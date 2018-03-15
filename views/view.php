<?php
class View
{
    private $_file;
    private $_t;

    public function __construct($action)
    {
        $this->_file = 'views/view' .$action. '.php';
    }
    //GENERE ET AFFICHE LA VUE
    public function generate($data)
    {
        //PARTIE SPECIFIQUE DE LA VUE
        $content = $this->generateFile($this->_file, $data);
        //TEMPLATE
        $view = $this->generateFile('views/template.php', array(
            't' => $this->_t,
            'content' => $content
        ));

        echo $view;
    }
    //GENERE UN FICHIER VUE ET RENVOIE LE RESULTAT PRODUIT
    private function generateFile($file, $data)
    {
        if(file_exists($file))
        {
            extract($data);

            ob_start();

            require $file;

            return ob_get_clean();
        }
        else 
            throw new Exception('Fichier ' .$file. ' introuvable');
    }
}