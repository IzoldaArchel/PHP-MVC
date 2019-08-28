<?php $this->titre = "Liste des Administrateurs"; ?>
<h2>Liste des Administrateurs </h2>

<form id="formAdmin" method="post" action="" name="triSubmit">
    <label>Trier par : </label>
    <select name="triParam">
        <option value="id_admin">Id admin</option>
        <option value="courriel">Identifiant</option>
        <option value="motdepass">Mot de pass</option>
    </select>
    <label>Ordre : </label>
    <select name="triOrder">
        <option value="ASC">Ascendant</option>
        <option value="DESC">Descendant</option>
    </select>
    <input class="trier" type="submit" value="Exécuter le tri" name="submit"/>
</form>

<a class="action" href="admin?item=administrateur&action=ajouter">Ajouter un administrateur</a>
<table>
    <tr>
        <th>Id administrateur</th>
        <th>Administrateur</th>
        <th>Identifiant</th>
        <th>Mot de pass</th>
        <th>Actions</th>
    </tr>

<?php foreach ($admins as $admin): // variable $livres provenant de la fonction extract($donnees) ?>
    <tr>
        <?php // "affichage en utilisant le résultat de la fonction extract($donnees)" ?>
        <td><?php echo $admin['id_admin'] ?></td>
        <td><?php echo $admin['admin'] ?></td>
        <td><?php echo $admin['courriel'] ?></td>
        <td><?php echo $admin['motdepass'] ?></td>
        <td><a class="action" href="admin?item=administrateur&id='<?php echo $admin['id_admin']; ?>'&action=modifier">modifier</a></td>
        <td><a class="action" href="admin?item=administrateur&id='<?php echo $admin['id_admin']; ?>'&action=supprimer">supprimer</a></td>
    </tr>
<?php endforeach; ?>
</table>