<?php

class Livre extends Entite {
    
 protected $id_livre = NULL; // nommage identique au champ MySQL correspondant
 protected $id_auteur = NULL; // nommage identique au champ MySQL correspondant
 protected $titre = NULL; // nommage identique au champ MySQL correspondant
 protected $annee = NULL; // nommage identique au champ MySQL correspondant
    
 public function __construct() {}
 protected function setId_livre($id_livre = NULL) {
    $this->id_livre = $id_livre;
 }
 protected function setId_auteur($id_auteur = NULL) {
     if (trim($id_auteur) === "") {
        $this->erreursHydrate['id_auteur'] = "Au moins un caractère.";
    }
    $this->id_auteur = trim($id_auteur);
 }

 protected function setTitre($titre = NULL) {
    if (trim($titre) === "") {
        $this->erreursHydrate['titre'] = "Au moins un caractère.";
    }
    $this->titre = trim($titre);
 }

 protected function setAnnee($annee = NULL) {
     if (trim($annee) === "") {
        $this->erreursHydrate['annee'] = "Au moins un caractère.";
     }
     $this->annee = trim($annee);
 }
    
    public function getTitre() {
        return $this->titre;
    }
    
} 