<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo str_replace("\\", "", Controleur::$base_uri) ?>/styles/styles.css">
    <title><?php echo $titre ?></title>
</head>
<body>
    <div id="global">
        <header>
            <h1>Administration de la bibliothèque <a class="retour" href="livres">Vers la bibliothèque</a></h1>
            
            <a class="connexion" href="admin?item=administrateur&action=deconnecter">deconnecter</a><br>
            <label class="connexion"><?php echo isset($_SESSION['identifiant']) ? $_SESSION['identifiant'] : "" ?></label><br>
            <ul>
                <li><a class="<?php echo $this->vue === "Administrateurs" ? "active" : ""; ?>"
                       href="admin?item=administrateur">Administrateurs</a></li>
                <li><a class="<?php echo $this->vue === "Auteurs" ? "active" : ""; ?>"
                       href="admin?item=auteur">Auteurs</a></li>
                <li><a class="<?php echo $this->vue === "AdminLivres" ? "active" : ""; ?>"
                       href="admin?item=livre">Livres</a></li>
            </ul>
        </header>
        <div id="contenu">
            <?php echo $contenu ?> <!-- contenu d'une vue spécifique -->
        </div>
        <footer>
        </footer>
    </div>
</body>
</html>