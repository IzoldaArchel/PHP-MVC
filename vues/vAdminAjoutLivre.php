<?php $this->titre = "Ajout Livre"; ?>
<h2>Ajout livre</h2>
<form method="post" action="" name="ajoutLivre">
    <label>Auteur : </label><br>
    <select name="auteur">
        <?php foreach($auteurs as $auteur) { ?>
        <option value="<?php echo $auteur['id_auteur']?>"><?php echo $auteur['auteur']?></option>
        <?php } ?>
    </select><br>
    <label>Titre : </label><br>
       <input type="text" name="titre"/><br>
    <label>Année : </label><br>
       <input type="text" name="annee"/><br>
    <input type="submit" class="envoyer" value="Envoyer" name="ajout"/>
</form>
