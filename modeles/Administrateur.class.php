<?php

class Administrateur extends Entite {
    
 protected $id_admin = NULL; // nommage identique au champ MySQL correspondant
 protected $nom = NULL; // nommage identique au champ MySQL correspondant
 protected $prenom = NULL; // nommage identique au champ MySQL correspondant
 protected $courriel = NULL;
 protected $motdepass = NULL;
 protected $erreurs = [];    
    
 public function __construct() {}
 protected function setId_admin($id_admin = NULL) {
    $this->id_admin = $id_admin;
 }

 protected function setNom($nom = NULL) {
    if (trim($nom) === "") {
        $this->erreursHydrate['nom'] = "Au moins un caractère.";
    }
    $this->nom = trim($nom);
 }

 protected function setPrenom($prenom = NULL) {
     if (trim($prenom) === "") {
        $this->erreursHydrate['prenom'] = "Au moins un caractère.";
     }
     $this->prenom = trim($prenom);
 }
    
protected function setCourriel($courriel = NULL) {
    if (!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
        $this->erreursHydrate['courriel'] = "Courriel incorrect.";
     }
    
     $this->courriel = trim($courriel);
 }
    
protected function setMotdepass($motdepass = NULL) {
     if (trim($motdepass) === "") {
        $this->erreursHydrate['motdepass'] = "Au moins un caractère.";
     }
     
     $this->motdepass = trim($motdepass);
    
    
 }
    
    public function getNom() {
        return $this->nom;
    }
    
    public function getCourriel() {
        return $this->courriel;
    }
    
    public function getErreurs() {
        return $this->erreurs;
    }
    
     public function validateAdmin($value) {
        if(isset($value) && strlen($value) >= 3) {
            return $value;
        }
        
     }
    
} 