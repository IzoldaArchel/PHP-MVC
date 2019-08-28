<?php $this->titre = "Ajout Admin"; ?>
<h2>Ajout d'administrateur</h2>
<form method="post" action="" name="ajoutAdmin">
    <label>Nom : </label><br>
       <input type="text" name="nom"/><br>
    <label>Prénom : </label><br>
       <input type="text" name="prenom"/><br>
    <label>Courriel : </label><br>
       <input type="text" name="courriel"/><br>
    <label>Mot de pass : </label><br>
       <input type="text" name="motdepass"/><br>
    <input type="submit" class="envoyer" value="Ajouter" name="ajout"/>
    <span><?=$champsValid ?></span>
</form>
