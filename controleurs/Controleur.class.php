<?php

class Controleur {

    public static $base_uri = "\/mvc";
    
    private $controleurs = array(
        ""          => "ControleurAccueil",
        "livres"    => "ControleurLivres",
        "admin"     => "ControleurAdmin"
    ); 

    /**
     * Constructeur qui valide l'URI et instancie le controleur correspondant
     *
     */
    public function __construct() {
        try {
            $regExp = '/^'.self::$base_uri.'[\/]?([^\?]*)(\?.*)?$/';
            $requestUri = strtolower($_SERVER["REQUEST_URI"]);
            if (preg_match($regExp, $requestUri, $result)) {
                foreach ($this->controleurs as $uri => $controleur) {
                    if ($uri == $result[1]) {
                        new $controleur;
                        exit;
                    }
                }
            }
            throw new exception ('URL non valide.');
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }

    /**
     * Error message 
     *
     */
    private function erreur($msgErreur) {
        $vue = new Vue("Erreur", array('msgErreur' => $msgErreur), 'gabaritErreur');
    }

}