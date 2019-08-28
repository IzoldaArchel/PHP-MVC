<?php


class ControleurAdmin {

    private $item    = "livre";
    private $action  = "get";
    private $id      = "";
    
     /**
      * Contrôle de l'URL pour exécuter l'action qui en découle
      *
      */  
     public function __construct() {
          session_start();     
          if (isset($_SESSION['identifiant'])) {

               $this->item   = isset($_GET['item'])   ? $_GET['item']   : "livre";
               $this->action = isset($_GET['action']) ? $_GET['action'] : "get";
               $this->id     = isset($_GET['id'])     ? $_GET['id']     : "";
               
               if (in_array($this->item, ["administrateur", "livre", "auteur"])) {
                    if (in_array($this->action, ["get", "ajouter", "modifier", "supprimer"])) {
                         $item   = ucfirst($this->item);
                         $action = $this->action;
                         if ($action === "get") $item .= "s";
                         $methode = $action.$item;
                         $this->$methode();
                         exit;
                    }
                    if ($this->action === "deconnecter") {
                        
                         $this->deconnecter();
                         exit;
                    }
                    throw new exception ("Action invalide");
               }
               throw new exception ("Item invalide");
         }
         else {
             $this->connecter();
             
         }
     }
    
     private function connecter() {
         if(isset($_POST['connect'])){
             $courriel = $_POST['courriel'];
             $motdepass = $_POST['motdepass'];
             //password_hash($_POST['motdepass'], PASSWORD_DEFAULT);
             $reqPDO = new RequetesPDO();
             $admin = $reqPDO->controlerUtilisateur($courriel, $motdepass); //, $motdepass
             if($admin !== 0) {
                 $_SESSION['identifiant'] = $courriel;
                 $reqPDO = new RequetesPDO();
                 $livres = $reqPDO->getLivresAdmin();
                 $vue = new Vue("AdminLivres", array('livres' => $livres), 'gabaritAdmin');
                 
             }
             else {
                 echo "connection pas effectue.";
             }
        }
         else {
             $vue = new Vue("Connexion", array(), 'gabaritAdmin');
         }
     }
    
     private function deconnecter() {
         unset($_SESSION['identifiant']);
         $this->connecter();
        
     }
     
     private function getAuteurs() {
        $this->triParam = isset($_POST['triParam']) ? $_POST['triParam'] : 'id_auteur';
        $this->triOrder = isset($_POST['triOrder']) ? $_POST['triOrder'] : 'ASC';
        $reqPDO = new RequetesPDO();
        $auteurs = $reqPDO->getAuteurs($this->triParam, $this->triOrder);
        $vue = new Vue("Auteurs", array('auteurs' => $auteurs), 'gabaritAdmin');
     }
    
     private function ajouterAuteur()   {
         $oAuteur = new Auteur();
         $erreursHydrate;
         $champs = array();
         $values = array();
         $message = "";
         if(isset($_POST['ajout'])){
             
             $this->nom = $_POST['nom'];
             $this->prenom = $_POST['prenom'];
             $values = array('nom' => $this->nom, 'prenom' => $this->prenom);
             $oAuteur->hydrate($values);
             $reqPDO = new RequetesPDO();
             $auteur = $reqPDO->ajouterItem('auteur', $values); 
             $message = "Vous avez ajouté un auteur ".$this->nom." ".$this->prenom.". Pour l'ajouter dans la liste veuillez ajouter ses livres.";
             $vue = new Vue("AdminAjoutAuteur", array('auteur' => $oAuteur, 'message' => $message), 'gabaritAdmin');

        }
         else {
              $vue = new Vue("AdminAjoutAuteur", array('auteur' => $oAuteur, 'message' => $message), 'gabaritAdmin');
         }
       
     }
    
     private function modifierAuteur()  {
         $oAuteur = new Auteur();
         $reqPDO = new RequetesPDO();
         $unAuteur = $reqPDO->getUnAuteur($this->id);
         $values = array();
         if(isset($_POST['modifier'])){
             $this->nom = $_POST['nom'];
             $this->prenom = $_POST['prenom'];
             $values = array('nom' => $this->nom, 'prenom' => $this->prenom);
             $oAuteur->hydrate($values);
             $reqPDO = new RequetesPDO();
             $auteur = $reqPDO->modifierItem('auteur', $values, $this->id, 'id_auteur'); 
             $auteurs = $reqPDO->getAuteurs( 'id_auteur', 'ASC');
             $vue = new Vue("Auteurs", array('auteurs' => $auteurs), 'gabaritAdmin');
        }
        
         else {
             $vue = new Vue("AdminModifierAuteur", array('auteur' => $oAuteur, 'unAuteur' => $unAuteur), 'gabaritAdmin');
         }
     }
    
     private function supprimerAuteur() {
        $reqPDO = new RequetesPDO();
        $suppression = $reqPDO->deleteAuteur($this->id);
        $auteurs = $reqPDO->getAuteurs($this->triParam, $this->triOrder);
        $vue = new Vue("Auteurs", array('auteurs' => $auteurs), 'gabaritAdmin');
      
     }
     
     private function getLivres() {
        $reqPDO = new RequetesPDO();
        $livres = $reqPDO->getLivresAdmin();
        $vue = new Vue("AdminLivres", array('livres' => $livres), 'gabaritAdmin'); 
     }
    
     private function ajouterLivre() {
        $reqPDO = new RequetesPDO();
        $auteurs = $reqPDO->getTousAuteurs();
        $oLivre = new Livre();
       
        $values = array();
        if(isset($_POST['ajout'])){
             $this->id_auteur = $_POST['auteur'];
             $this->titre = $_POST['titre'];
             $this->annee = $_POST['annee'];
             $values = array('id_auteur' => $this->id_auteur, 'titre' => $this->titre, 'annee' => $this->annee);
             $oLivre->hydrate($values);
             $reqPDO = new RequetesPDO();
             $livre = $reqPDO->ajouterItem('livre', $values); 
             $livres = $reqPDO->getLivresAdmin();
             $vue = new Vue("AdminLivres", array('livres' => $livres), 'gabaritAdmin');
        }
         else {
              $vue = new Vue("AdminAjoutLivre", array('livre' => $oLivre, 'auteurs' => $auteurs), 'gabaritAdmin');
         }
     }
    
     private function modifierLivre() {
         $reqPDO = new RequetesPDO();
         $auteurs = $reqPDO->getTousAuteurs();
         $livre = $reqPDO->getUnLivre($this->id);
         $oLivre = new Livre();
         $values = array();
         if(isset($_POST['modifier'])){
             $this->id_auteur = $_POST['auteur'];
             $this->titre = $_POST['titre'];
             $this->annee = $_POST['annee'];
             $values = array('id_auteur' => $this->id_auteur, 'titre' => $this->titre, 'annee' => $this->annee);
             $oLivre->hydrate($values);
             $reqPDO = new RequetesPDO();
             $livre = $reqPDO->modifierItem('livre', $values, $this->id, 'id_livre');
             $livres = $reqPDO->getLivresAdmin();
             $vue = new Vue("AdminLivres", array('livres' => $livres), 'gabaritAdmin'); 
        }
         else {
              $vue = new Vue("AdminModifierLivre", array('livre' => $oLivre, 'auteurs' => $auteurs, 'livre' => $livre), 'gabaritAdmin');
         }

     }
     private function supprimerLivre() {
        $reqPDO = new RequetesPDO();
        $suppression = $reqPDO->supprimerItem('livre', $this->id, 'id_livre');
        $livres = $reqPDO->getLivresAdmin();
        $vue = new Vue("AdminLivres", array('livres' => $livres), 'gabaritAdmin'); 
     }
     
     private function getAdministrateurs() {
        $this->triParam = isset($_POST['triParam']) ? $_POST['triParam'] : 'id_admin';
        $this->triOrder = isset($_POST['triOrder']) ? $_POST['triOrder'] : 'ASC';
        $reqPDO = new RequetesPDO();
        $admins = $reqPDO->getAdministrateurs($this->triParam, $this->triOrder);
        $vue = new Vue("Administrateurs", array('admins' => $admins), 'gabaritAdmin');
     }
    
     private function ajouterAdministrateur() {
         $champsValid = "";
         $oAdmin = new Administrateur();
         $values = array();
         if(isset($_POST['ajout'])){
             
             $this->nom = $_POST['nom'];
             $this->prenom = $_POST['prenom'];
             $this->courriel = $_POST['courriel'];
             $this->motdepass = password_hash($_POST['motdepass'], PASSWORD_DEFAULT);
             if($oAdmin->validateAdmin($_POST['courriel']) && $oAdmin->validateAdmin($_POST['motdepass'])) {
                 $values = array('nom' => $this->nom, 'prenom' => $this->prenom, 'courriel' => $this->courriel, 'motdepass' => $this->motdepass);
                 $oAdmin->hydrate($values);
                 $reqPDO = new RequetesPDO();
                 $admin = $reqPDO->ajouterItem('admin', $values);
                 // return to the admin list if item added
                 $admins = $reqPDO->getAdministrateurs('id_admin', 'ASC');
                 $vue = new Vue("Administrateurs", array('admins' => $admins), 'gabaritAdmin');
                
             }
             else {
                 $champsValid = "L'identifiant et mot de pass doivent comporter au moins 8 caractères.";
                 $vue = new Vue("AdminAjoutAdministrateur", array('admin' => $oAdmin, 'champsValid' => $champsValid), 'gabaritAdmin');
             }
        }
         else {
              $vue = new Vue("AdminAjoutAdministrateur", array('admin' => $oAdmin, 'champsValid' => $champsValid), 'gabaritAdmin');
         }
         
     }
    
     private function modifierAdministrateur() {
         $oAdmin = new Administrateur();
         $reqPDO = new RequetesPDO();
         $unAdmin = $reqPDO->getAdmin($this->id);
         
         $values = array();
         if(isset($_POST['modifier'])){
             $this->nom = $_POST['nom'];
             $this->prenom = $_POST['prenom'];
             $this->courriel = $_POST['courriel'];
             $this->motdepass = password_hash($_POST['motdepass'], PASSWORD_DEFAULT);  //password encryprion
             $values = array('nom' => $this->nom, 'prenom' => $this->prenom, 'courriel' => $this->courriel, 'motdepass' => $this->motdepass);
             $oAdmin->hydrate($values);
             $reqPDO = new RequetesPDO();
             $auteur = $reqPDO->modifierItem('admin', $values, $this->id, 'id_admin'); 
             $admins = $reqPDO->getAdministrateurs('id_admin', 'ASC');
             $vue = new Vue("Administrateurs", array('admins' => $admins), 'gabaritAdmin');
        }
         else {
             $vue = new Vue("AdminModifierAdministrateur", array('admin' => $oAdmin, 'unAdmin' => $unAdmin), 'gabaritAdmin');
         }
     }
    
     private function supprimerAdministrateur() {
        $this->triParam = isset($_POST['triParam']) ? $_POST['triParam'] : 'id_admin';
        $this->triOrder = isset($_POST['triOrder']) ? $_POST['triOrder'] : 'ASC';
        $oAdmin = new Administrateur();
        $reqPDO = new RequetesPDO();
        $suppression = $reqPDO->supprimerItem('admin', $this->id, 'id_admin') ;
        $admins = $reqPDO->getAdministrateurs($this->triParam, $this->triOrder);
        $vue = new Vue("Administrateurs", array('admins' => $admins), 'gabaritAdmin');
     }
}