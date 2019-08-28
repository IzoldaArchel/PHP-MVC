<?php $this->titre = "Recherche des livres"; ?>
<h2>Recherche des livres</h2>
<form method="post" action="" name="triSubmit">
    <label>Année : </label>
    <input class="recherche" type="text" name="annee" />
    <label>Le titre contient : </label>
    <input class="recherche" type="text" name="contain" />
    <input class="trier"  type="submit" value="Lancer la recherche" name="submit"/>
</form>
<span><?= $message ?></span>
<?php if($livres2) { ?>
<table>
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Année</th>
    </tr>
<?php } ?>    
<?php foreach ($livres2 as $livre): // variable $livres provenant de la fonction extract($donnees) ?>
    <tr>
        <?php // "affichage en utilisant le résultat de la fonction extract($donnees)" ?>
        <td><?php echo $livre['titre'] ?></td>
        <td><?php echo $livre['auteur'] ?></td>
        <td><?php echo $livre['annee'] ?></td>
    </tr>
<?php endforeach; ?>

</table>