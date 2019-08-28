<?php

class ControleurLivres {
    
    private $triParam;
    private $triOrder;
    private $annee;
    private $contain;
      
    private $action;
   
    public function __construct() {
    
        if(isset($_GET['action'])) {

            $this->chercherLivre();
            
          
        }
        
        else{
                $this->triParam = isset($_POST['triParam']) ? $_POST['triParam'] : 'annee';
                $this->triOrder = isset($_POST['triOrder']) ? $_POST['triOrder'] : 'ASC';
          
            $this->getLivres();
        }
    }
   

    /**
     * Affiche la page de liste des livres
     *
     */  
    
    private function getLivres() {
        
        $reqPDO = new RequetesPDO();
        $livres = $reqPDO->getLivres($this->triParam, $this->triOrder);
        $vue = new Vue("Livres", array('livres' => $livres));
        
    }
    
    private function chercherLivre() {
      $livres = array();
      $horsDisponible = "Année hors de la période disponible.";
      $nonValide = "Année non valide.";
      $message = '';   
       if(isset($_POST['submit'])){
                $this->annee = $_POST['annee'];
                $this->contain = $_POST['contain'];
                if (is_numeric(substr($this->annee, 0, 4)) && ($this->annee < 1500 || $this->annee > date("Y"))) {
                    $message = "Année hors de la période disponible.";
                }
                else if (!is_numeric(substr($this->annee, 0, 4)) && $this->annee!="") {
                    $message = "Année non valide.";
                }
                else {
                $reqPDO = new RequetesPDO();
                $livres = $reqPDO->chercherLivre($this->annee, $this->contain);
                }
           
            }
        $vue = new Vue("Recherche", array('livres2' => $livres, 'message' => $message));
        
        
    }
    
    
    
}