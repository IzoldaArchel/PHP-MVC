<?php $this->titre = "Liste des Auteurs"; ?>
<h2>Liste des Auteurs</h2>
<form id="formAdmin" method="post" action="" name="triSubmit">
    <label>Trier par : </label>
    <select name="triParam">
        <option value="id_auteur">Id auteur</option>
        <option value="auteur">Auteur</option>
        <option value="nb_livres">Nb_livres</option>
    </select>
    <label>Ordre : </label>
    <select name="triOrder">
        <option value="ASC">Ascendant</option>
        <option value="DESC">Descendant</option>
    </select>
    <input class="trier" type="submit" value="Exécuter le tri" name="submit"/>
</form>
<a class="action" href="admin?item=auteur&action=ajouter">Ajouter un auteur</a>
<table>
    <tr>
        <th>Id auteur</th>
        <th>Auteur</th>
        <th>Nb_livres</th>
        <th>Actions</th>
    </tr>

<?php foreach ($auteurs as $auteur):  ?>
    <tr>
        <?php // "affichage en utilisant le résultat de la fonction extract($donnees)" ?>
        <td><?php echo $auteur['id_auteur'] ?></td>
        <td><?php echo $auteur['Auteur'] ?></td>
        <td><?php echo $auteur['nb_livres'] ?></td>
        <td><a href="admin?item=auteur&id='<?php echo $auteur['id_auteur']; ?>'&action=modifier">modifier</a></td>
        <td><a href="admin?item=auteur&id='<?php echo $auteur['id_auteur']; ?>'&action=supprimer">supprimer</a></td>
    </tr>
<?php endforeach; ?>
</table>