<?php $this->titre = "Modification d'administrateur"; ?>
<h2>Modification d'Administrateur <?php echo $unAdmin['courriel'] ?></h2>
<form method="post" action="" name="modifierAuteur">
    <label>Nom : </label><br>
       <input class="modifier" type="text" name="nom" value="<?php echo $unAdmin['nom'] ?>"/><br>
    <label>Prénom : </label><br>
       <input class="modifier" type="text" name="prenom" value="<?php echo $unAdmin['prenom'] ?>"/><br>
    <label>Courriel : </label><br>
       <input class="modifier" type="text" name="courriel" value="<?php echo $unAdmin['courriel'] ?>"/><br>
    <label>Mot de pass : </label><br>
       <input class="modifier" type="text" name="motdepass" value="<?php echo $unAdmin['motdepass'] ?>"/><br>
    <input class="trier" type="submit" value="Modifier" name="modifier"/>
</form>