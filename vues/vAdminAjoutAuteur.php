<?php $this->titre = "Ajout Auteur"; ?>
<h2>Ajout Auteur</h2>
<form method="post" action="" name="ajoutAuteur">
    <label>Nom : </label><br>
       <input type="text" name="nom"/><br>
    <label>Prénom : </label><br>
       <input type="text" name="prenom"/><br>
    <input type="submit" class="envoyer" value="Ajouter" name="ajout"/>
    <br><span><?php echo $message ?></span>
</form>

