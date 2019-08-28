
<?php
/**
 * @file index.php
 * @author Kolomiets Elena
 * @version 1.0
 * @date 29 avril 2019
 * @brief La page d'accueuil.
*/
require_once('includes/chargementClasses.inc.php');

//echo "SERVER_PROTOCOL : ".$_SERVER["SERVER_PROTOCOL"]."<br>";
//echo "REQUEST_METHOD : ".$_SERVER["REQUEST_METHOD"]."<br>";
//echo "REQUEST_URI : ".$_SERVER["REQUEST_URI"]."<br>";
//echo "QUERY_STRING : ".$_SERVER["QUERY_STRING"]."<br>";
//echo "<pre>".print_r($_SERVER, true)."</pre>";
//echo "<pre>".print_r($_POST, true)."</pre>";
//exit;

$routeur = new Controleur();
