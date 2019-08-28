<?php $this->titre = "Ajout Auteur"; ?>
<h2>Modification d'auteur <?php echo $unAuteur['prenom']." ".$unAuteur['nom']  ?></h2>
<form method="post" action="" name="modifierAuteur">
    <label>Nom : </label><br>
       <input class="modifier" type="text" name="nom" value="<?php echo $unAuteur['nom']  ?>"/><br>
    <label>Prénom : </label><br>
       <input class="modifier" type="text" name="prenom" value="<?php echo $unAuteur['prenom'] ?>"/><br>
    <input class="trier" type="submit" value="Envoyer" name="modifier"/>
</form>