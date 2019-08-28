<?php

class RequetesPDO {
    
    public function getLivres($triParam, $triOrder) {
        try {
            $sPDO = SingletonPDO::getInstance();
            $oPDOStatement = $sPDO->prepare(
                "SELECT LI.id_livre, LI.id_auteur, LI.titre as titre, LI.annee as annee, CONCAT(AU.nom,' ', AU.prenom) AS auteur
                 FROM auteur AU 
                 INNER JOIN livre LI ON AU.id_auteur = LI.id_auteur
                 ORDER  BY ".$triParam." ".$triOrder.""
            );
            
            $oPDOStatement->execute();
            $livres = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            return $livres;
        } catch(PDOException $e) {
            throw $e;
        }
    }
    
    
    public function chercherLivre($annee=0, $contain='') {
        try {
            $sPDO = SingletonPDO::getInstance();
            $contain = "%".$contain."%";
            $condition = "WHERE";
            if ($annee != 0) $condition = $condition." annee = :annee";
            if ($annee != 0 && $contain != '') $condition = $condition." AND";
            if ($contain != '') $condition = $condition." titre LIKE :contain";
            $oPDOStatement = $sPDO->prepare(
                "SELECT LI.id_livre, LI.id_auteur, LI.titre as titre, LI.annee as annee, CONCAT(AU.nom,' ', AU.prenom) AS auteur
                 FROM auteur AU 
                 INNER JOIN livre LI ON AU.id_auteur = LI.id_auteur
                 ".$condition." " 
            );
            if ($annee != 0)
                $oPDOStatement->bindParam(':annee', $annee, PDO::PARAM_INT);
            if ($contain != '')
                $oPDOStatement->bindParam(':contain', $contain , PDO::PARAM_STR);
           
            $oPDOStatement->execute();
            $livres = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            return $livres;
        } catch(PDOException $e) {
            throw $e;
        }
    }
    
     public function getAuteurs($triParam, $triOrder) {
        try {
            $sPDO = SingletonPDO::getInstance();
            $oPDOStatement = $sPDO->prepare(
               "SELECT auteur.id_auteur, CONCAT(nom, ' ', prenom) AS Auteur, COUNT(id_livre) AS nb_livres
                FROM auteur 
                INNER JOIN livre ON auteur.id_auteur = livre.id_auteur
                GROUP BY auteur.id_auteur
                ORDER BY ".$triParam." ".$triOrder.""
            );
            
            $oPDOStatement->execute();
            $auteurs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            return $auteurs;
        } catch(PDOException $e) {
            throw $e;
        }
    }
    
    public function ajouterItem($table, $champs) {
        $sPDO = SingletonPDO::getInstance();
        try {
            $req = "INSERT INTO ".$table. " SET ";
            foreach ($champs as $nom => $valeur) {
                $req .= $nom."=:".$nom.", ";
            }
            if ($nom != "")
            $req = substr($req, 0, -2);
            $oPDOStatement = $sPDO->prepare($req);
            foreach ($champs as $nom => $valeur) {
                $oPDOStatement->bindValue(":".$nom, $valeur);
            }
            if ($valeur != "")
            $oPDOStatement->execute();
            
            if ($oPDOStatement->rowCount() == 0) {
                //return "Ajout non effectué.";
                echo "Ajout non effectue";
            } else {
                 //echo "Ajout effectue";
                return 0;
            }
        }
        catch (Exception $e) {
            if ($e->getCode() === self::ERREUR_MYSQL_INTEGRITY_CONSTRAINT_VIOLATION) {
                return ucfirst($table)." déjà présent."; // identifiant administrateur
            } else {
                throw $e;
            }
        }
    }

        public function modifierItem($table, $champs, $id, $id_table) {
            
        $sPDO = SingletonPDO::getInstance();
        try {
            $req = "UPDATE ".$table. " SET ";
            foreach ($champs as $nom => $valeur) {
                $req .= $nom."=:".$nom.", ";
            }
            if ($nom != "")
            $req = substr($req, 0, -2);
            $req .= " WHERE ".$id_table." = ".$id;
            $oPDOStatement = $sPDO->prepare($req);
            foreach ($champs as $nom => $valeur) {
                $oPDOStatement->bindValue(":".$nom, $valeur);
            }
            if ($valeur != "")
            $oPDOStatement->execute();
            
            if ($oPDOStatement->rowCount() == 0) {
                return "Modification non effectué.";
                //echo "Modification non effectue";
            } else {
                 //echo "Modification effectue";
                return 0;
            }
        }
        catch (Exception $e) {
            if ($e->getCode() === self::ERREUR_MYSQL_INTEGRITY_CONSTRAINT_VIOLATION) {
                return ucfirst($table)." déjà présent."; // identifiant administrateur
            } else {
                throw $e;
            }
        }
    }
    
    public function deleteAuteur($id) {

        $sPDO = SingletonPDO::getInstance();
        try {
            $sPDO->beginTransaction();
            $req = "DELETE FROM livre WHERE id_auteur = ".$id;
            //$del1->bindValue(":id", $id, PDO::PARAM_INT);
            $del1 = $sPDO->prepare($req);
            $del1->execute(); 

            $req2 = "DELETE FROM auteur WHERE id_auteur = ".$id;
            //$oPDOStatement->bindValue(":id", $id, PDO::PARAM_INT);
            $oPDOStatement = $sPDO->prepare($req2);
            $oPDOStatement->execute();
            $sPDO->commit();
            
            return true;
        }

        catch (Exception $e) {
            $sPDO->rollBack();
            throw $e;
        }
  }
    
    public function getAdministrateurs($triParam, $triOrder) {
        try {
            $sPDO = SingletonPDO::getInstance();
            $oPDOStatement = $sPDO->prepare(
               "SELECT id_admin, CONCAT(nom, ' ', prenom) AS admin, courriel, motdepass
                FROM admin
                ORDER BY ".$triParam." ".$triOrder.""
            );
            
            $oPDOStatement->execute();
            $auteurs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            return $auteurs;
        } catch(PDOException $e) {
            throw $e;
        }
    }

    public function supprimerItem($table, $id, $id_table) {
       
        $sPDO = SingletonPDO::getInstance();
        try {
            $req = "DELETE FROM ".$table." WHERE ".$id_table." = ".$id;
            $oPDOStatement = $sPDO->prepare($req);
            $oPDOStatement->bindValue(":table", $table, PDO::PARAM_STR);
            $oPDOStatement->bindValue(":id", $id, PDO::PARAM_INT);
            $oPDOStatement->bindValue(":id_table", $id_table, PDO::PARAM_STR);
            
            $oPDOStatement->execute();
            if ($oPDOStatement->rowCount() == 0) {
                return "Suppression non effectué.";
                //echo "Suppression non effectue";
            } else {
                 //echo "Suppression effectue";
                return 0;
            }
        }
        catch (Exception $e) {
                throw $e;
            }
        }
   
/**
 * Fonction getPassword
 * @brief contrôle l'authentification de l'utilisateur dans la table admin
 * @param $identifiant = courriel pour l'authentification
 * @return $motdepasse trouvé
 */
    
public function getPassword($identifiant) {
        try {
            $sPDO = SingletonPDO::getInstance();
            $oPDOStatement = $sPDO->prepare(
               "SELECT motdepass
                FROM admin
                WHERE courriel = '$identifiant'");
            
            $oPDOStatement->execute();
            $motdepass = $oPDOStatement->fetchColumn();
            return $motdepass;
        } catch(PDOException $e) {
            throw $e;
        }
    }    
   
/**
 * Fonction controlerUtilisateur
 * @brief contrôle l'authentification de l'utilisateur dans la table admin
 * @param $identifiant = courriel pour l'authentification
 * @param $password = mot de passe pour l'authentification
 * @return 1 si l'utilisateur avec $identifiant et $password trouvé
 *         0 si non trouvé
 */    
public function controlerUtilisateur($identifiant, $password) { 
       $sPDO = SingletonPDO::getInstance();

     try {
         echo $identifiant;
            $motdepass = $this->getPassword($identifiant);
            //verifier si motdepass = motdepass encrypté
            if (password_verify($password, $motdepass)) { 
            $oPDOStatement = $sPDO->prepare(
               "SELECT * FROM admin WHERE courriel = '$identifiant'");
               // echo " avant";
                $oPDOStatement->execute();
            
             //echo "Entree effectue";
                return 1;
                if ($oPDOStatement->rowCount() == 0) {
                return 0;
                //echo "Entree non effectue";
                }
         }
         else {
            // echo ' Invalid password.';
             exit;
         }
         } catch(PDOException $e) {
            throw $e;
        }
    
}  
/**
 * Fonction getLivresAdmin
 * @brief retourne liste complet de livres avec auteur indique
 * @param null
 * @return liste de livres
 */      
public function getLivresAdmin() {
    
     try {
            $sPDO = SingletonPDO::getInstance();
            $oPDOStatement = $sPDO->prepare(
            "SELECT livre.id_livre, CONCAT(auteur.nom, ' ', auteur.prenom) AS auteur, livre.titre, livre.annee, livre.id_auteur 
            FROM livre
            INNER JOIN auteur ON auteur.id_auteur = livre.id_auteur");
            
            $oPDOStatement->execute();
            $livres = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            return $livres;
        } catch(PDOException $e) {
            throw $e;
        }
    
}
    
/**
 * Fonction getUnLivre
 * @brief retourne un livre ayant id_livre indique
 * @param null
 * @return un livre 
 */      
public function getUnLivre($id) {
    
     try {
            $sPDO = SingletonPDO::getInstance();
            $oPDOStatement = $sPDO->prepare(
            "SELECT id_livre, titre, annee
            FROM livre
            WHERE id_livre = ".$id);
            $oPDOStatement->bindParam(":id", $id, PDO::PARAM_INT);
            $oPDOStatement->execute();
            $livre = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
            return $livre;
        } catch(PDOException $e) {
            throw $e;
        }
    
}

/**
 * Fonction getAdmin
 * @brief retourne un Admin ayant id_livre indique
 * @param null
 * @return un Admin 
 */      
public function getAdmin($id) {
    
     try {
            $sPDO = SingletonPDO::getInstance();
            $oPDOStatement = $sPDO->prepare(
            "SELECT *
            FROM admin
            WHERE id_admin = ".$id);
            $oPDOStatement->bindParam(":id", $id, PDO::PARAM_INT);
            $oPDOStatement->execute();
            $livre = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
            return $livre;
        } catch(PDOException $e) {
            throw $e;
        }
    
}
    
/**
 * Fonction getUnAuteur
 * @brief retourne un auteur ayant id_auteur indique
 * @param null
 * @return un auteur 
 */      
public function getUnAuteur($id) {
    
     try {
            $sPDO = SingletonPDO::getInstance();
            $oPDOStatement = $sPDO->prepare(
            "SELECT *
            FROM auteur
            WHERE id_auteur = ".$id);
            $oPDOStatement->bindParam(":id", $id, PDO::PARAM_INT);
            $oPDOStatement->execute();
            $auteur = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
            return $auteur;
        } catch(PDOException $e) {
            throw $e;
        }
    
}    
    /**
 * Fonction getTousAuteurs
 * @brief retourne liste complet des auteurs
 * @param null
 * @return liste d'auteurs
 */  
    public function getTousAuteurs() {
        try {
            $sPDO = SingletonPDO::getInstance();
            $oPDOStatement = $sPDO->prepare(
               "SELECT id_auteur, CONCAT(nom, ' ', prenom) AS auteur
                FROM auteur"
            );
            
            $oPDOStatement->execute();
            $auteurs = $oPDOStatement->fetchAll(PDO::FETCH_ASSOC);
            return $auteurs;
        } catch(PDOException $e) {
            throw $e;
        }
    }

    
    
}