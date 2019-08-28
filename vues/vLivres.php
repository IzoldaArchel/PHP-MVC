<?php $this->titre = "Liste des livres"; ?>
<h2>Liste des livres</h2>
<form method="post" action="" name="triSubmit">
    <label>Trier par : </label>
    <select name="triParam">
        <option value="titre">Titre</option>
        <option value="auteur">Auteur</option>
        <option value="annee">Année</option>
    </select>
    <label>Ordre : </label>
    <select name="triOrder">
        <option value="ASC">Ascendant</option>
        <option value="DESC">Descendant</option>
    </select>
    <input class="trier" type="submit" value="Exécuter le tri" name="submit"/>
</form>


<table>
    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Année</th>
    </tr>

<?php  // foreach ($donnees['livres'] as $livre): // utilisation directe de $donnees ?>

<?php foreach ($livres as $livre): // variable $livres provenant de la fonction extract($donnees) ?>
    <tr>
        <?php // "affichage en utilisant le résultat de la fonction extract($donnees)" ?>
        <td><?php echo $livre['titre'] ?></td>
        <td><?php echo $livre['auteur'] ?></td>
        <td><?php echo $livre['annee'] ?></td>
    </tr>
<?php endforeach; ?>
</table>