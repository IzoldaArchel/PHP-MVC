<?php $this->titre = "Modifier Livre"; 
    $this->id = $_GET['id'];
?>
<h2>Modifier Livre <?php echo $livre['titre'] ?></h2>
<form method="post" action="" name="modifierAuteur">
    <label>Auteur : </label><br>
    <select class="modifier" name="auteur">
        <?php foreach($auteurs as $auteur) { ?>
        <option value="<?php echo $auteur['id_auteur']?>"><?php echo $auteur['auteur']?></option>
        <?php } ?>
    </select><br>
    <label>Titre : </label><br>
       <input class="modifier" type="text" name="titre" value="<?php echo $livre['titre'] ?>"/><br>
    <label>Année : </label><br>
       <input class="modifier" type="text" name="annee" value="<?php echo $livre['annee'] ?>"/><br>
    <input class="trier" type="submit" value="Modifier" name="modifier"/>
</form>