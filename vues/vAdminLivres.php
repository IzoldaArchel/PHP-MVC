<?php $this->titre = "Liste de livres - page d'administrateurs"; ?>

<h2>Liste de livres </h2>
<a class="action" href="admin?item=livre&action=ajouter">Ajouter un livre</a>
<table>
    <tr>
        <th>Id livre</th>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Année</th>
        <th>Actions</th>
    </tr>

<?php foreach ($livres as $livre): // variable $livres provenant de la fonction extract($donnees) ?>
    <tr>
        <?php // "affichage en utilisant le résultat de la fonction extract($donnees)" ?>
        <td><?php echo $livre['id_livre'] ?></td>
        <td><?php echo $livre['auteur'] ?></td>
        <td><?php echo $livre['titre'] ?></td>
        <td><?php echo $livre['annee'] ?></td>
        <td><a href="admin?item=livre&id='<?php echo $livre['id_livre']; ?>'&action=modifier">modifier</a></td>
        <td><a href="admin?item=livre&id='<?php echo $livre['id_livre']; ?>'&action=supprimer">supprimer</a></td>
    </tr>
<?php endforeach; ?>
</table>